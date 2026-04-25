<?php

namespace App\Livewire;

use App\Models\GroomingApplication;
use App\Models\GroomingBatch;
use App\Models\GroomingGallery;
use App\Models\GroomingNotice;
use App\Models\Setting;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminAlertNotification;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Services\FacebookCapiService;

#[Title('Grooming Class | Dhaka Model Agency')]
#[Layout('layouts.app')]
class GroomingPage extends Component
{
    use WithFileUploads, WithPagination;

    // ── Step state ──
    // 0 = member lookup screen
    // 1 = Personal Info
    // 2 = Physical Info
    // 3 = Career Interest
    // 4 = Batch Selection
    // 5 = Payment
    public int $step = 0;
    public int $totalSteps = 5; // visible steps (1–5), step 0 is pre-form

    // ── Member Lookup ──
    public bool $isMemberCheck = false;
    public string $memberLookupInput = '';
    public ?string $memberLookupError = null;
    public ?int $linkedUserId = null;
    public bool $isPreFilled = false;

    // ── Step 1: Personal Info ──
    public string $full_name = '';
    public string $phone = '';
    public string $whatsapp = '';
    public string $email = '';

    // ── Step 2: Physical Info ──
    public string $age = '';
    public string $gender = '';
    public string $height = '';
    public string $weight = '';
    public string $address = '';

    // ── Step 3: Career Interest ──
    public array $career_interests = [];
    public string $experience_level = '';

    // ── Step 4: Batch Selection ──
    public string $batch_id = '';

    // ── Step 5: Payment ──
    public string $payment_method = '';
    
    public string $sender_number = '';
    public string $transaction_id = '';
    public $payment_screenshot = null;

    // ── UI ──
    public bool $submitted = false;
    public ?int $applicationId = null;

    // ─────────────────────────────────────────
    // Member Lookup
    // ─────────────────────────────────────────

    public function lookupMember(): void
    {
        $this->memberLookupError = null;

        $this->validate([
            'memberLookupInput' => 'required|string|min:3',
        ], [
            'memberLookupInput.required' => 'Please enter your Member ID or mobile number.',
            'memberLookupInput.min'      => 'Please enter at least 3 characters.',
        ]);

        $user = User::where('is_verified', true)
            ->where(function ($q) {
                $q->where('member_id', $this->memberLookupInput)
                  ->orWhere('phone', $this->memberLookupInput);
            })
            ->with('profile')
            ->first();

        if (! $user) {
            $this->memberLookupError = 'No verified member found with that ID or phone number. Please check and try again.';
            return;
        }

        // ── Auto-fill Step 1: Personal Info ──
        $this->full_name = $user->name  ?? '';
        $this->phone     = $user->phone ?? '';
        $this->email     = $user->email ?? '';
        // whatsapp stays empty — they can fill if needed

        // ── Auto-fill Step 2: Physical Info ──
        if ($user->profile) {
            $p = $user->profile;

            $this->gender = $p->gender ?? '';
            $this->height = $p->height_cm ?? '';
            $this->weight = $p->weight_kg ?? '';

            // Build address from available profile fields
            $this->address = trim(implode(', ', array_filter([
                $p->street_address,
                $p->upazila,
                $p->district,
                $p->country !== 'Bangladesh' ? $p->country : null,
            ])));

            // Calculate age from date of birth
            if ($p->date_of_birth) {
                $this->age = (string) Carbon::parse($p->date_of_birth)->age;
            }
        }

        $this->linkedUserId = $user->id;
        $this->isPreFilled  = true;

        // ── Jump directly to Step 3 (skip 1 & 2) ──
        $this->step = 3;
    }

    public function skipMemberLookup(): void
    {
        $this->isMemberCheck    = false;
        $this->memberLookupInput = '';
        $this->memberLookupError = null;
        $this->step = 1;
    }

    // ─────────────────────────────────────────
    // Validation Rules Per Step
    // ─────────────────────────────────────────

    protected function rulesForStep(): array
    {
        return match ($this->step) {
            1 => [
                'full_name' => 'required|string|max:255',
                'phone'     => 'required|string|max:20',
                'whatsapp'  => 'nullable|string|max:20',
                'email'     => 'nullable|email|max:255',
            ],
            2 => [
                'age'     => 'nullable|integer|min:10|max:60',
                'gender'  => 'nullable|in:Male,Female,Other',
                'height'  => 'nullable|string|max:20',
                'weight'  => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
            ],
            3 => [
                'career_interests' => 'nullable|array',
                'experience_level' => 'nullable|in:Beginner,Intermediate,Experienced',
            ],
            4 => [
                'batch_id' => 'required|exists:grooming_batches,id',
            ],
            5 => [
                'payment_method'    => 'required|string',
                'sender_number'     => 'required|string|max:20',
                'transaction_id'    => 'required|string|unique:grooming_applications,transaction_id',
                'payment_screenshot'=> 'nullable|image|max:3072',
            ],
            default => [],
        };
    }

    // ─────────────────────────────────────────
    // Navigation
    // ─────────────────────────────────────────

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep());
        $this->step++;
    }

    public function prevStep(): void
    {
        $previousStep = $this->step - 1;

        // If member was pre-filled, going back from step 3
        // should return to step 0 (lookup screen), not step 2
        if ($this->isPreFilled && $this->step === 3) {
            $this->step = 0;
            $this->isMemberCheck = true; // keep lookup panel open
            return;
        }

        $this->step = max(0, $previousStep);
    }

    // ─────────────────────────────────────────
    // Submit
    // ─────────────────────────────────────────

    public function submit(): void
    {
        $this->validate($this->rulesForStep());

        $screenshotPath = null;
        if ($this->payment_screenshot) {
            $screenshotPath = $this->payment_screenshot->store('grooming/payments', 'public');
        }

        $application = GroomingApplication::create([
            'user_id'            => $this->linkedUserId,
            'batch_id'           => $this->batch_id,
            'full_name'          => $this->full_name,
            'phone'              => $this->phone,
            'whatsapp'           => $this->whatsapp ?: null,
            'email'              => $this->email ?: null,
            'age'                => $this->age ?: null,
            'gender'             => $this->gender ?: null,
            'height'             => $this->height ?: null,
            'weight'             => $this->weight ?: null,
            'address'            => $this->address ?: null,
            'career_interests'   => !empty($this->career_interests) ? $this->career_interests : null,
            'experience_level'   => $this->experience_level ?: null,
            'payment_method'     => $this->payment_method,
            'sender_number'      => $this->sender_number,
            'transaction_id'     => $this->transaction_id,
            'payment_screenshot' => $screenshotPath,
            'status'             => 'pending',
            'payment_status'     => 'unpaid',
        ]);

        GroomingBatch::where('id', $this->batch_id)->increment('filled_seats');

        $admins = User::role('Super-Admin')->get();

        try {
            Notification::send($admins, new AdminAlertNotification(
                'New Grooming Application',
                "{$this->full_name} ({$this->phone}) has applied for a grooming class. TrxID: {$this->transaction_id}.",
                'Review Application',
                url('/admin/grooming-applications')
            ));
        } catch (\Exception $e) {
            Log::error('Grooming admin email notification failed: ' . $e->getMessage());
        }

        FilamentNotification::make()
            ->title('New Grooming Application 🎓')
            ->body("{$this->full_name} ({$this->phone}) applied. TrxID: {$this->transaction_id}. [Review](/admin/grooming-applications)")
            ->success()
            ->sendToDatabase($admins);

        $this->applicationId = $application->id;
        $this->submitted = true;
        // --- Trigger Facebook CAPI CompleteRegistration Event ---
        try {
            // Fetch the fee from the selected batch
            $batch = GroomingBatch::find($this->batch_id);
            $fee = $batch ? $batch->fee : 0;

            // Use the database Application ID as the unique deduplication key
            $uniqueEventId = 'GROOM_APP_' . $application->id; 

            $capiService = new FacebookCapiService();
            $capiService->sendRegistrationEvent(
                [
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'name'  => $this->full_name,
                ],
                $fee,
                request()->url(),
                $uniqueEventId // Pass the deduplication ID here
            );
        } catch (\Exception $e) {
            // Silently fail if CAPI crashes so the user still sees the success screen
            Log::error('CAPI Trigger Error: ' . $e->getMessage());
        }
    }

    // ─────────────────────────────────────────
    // Render
    // ─────────────────────────────────────────

    public function render()
    {
        $batches = GroomingBatch::where('is_active', true)
            ->whereIn('status', ['open', 'filling_fast'])
            ->orderBy('start_date')
            ->get();

        $gallery = GroomingGallery::orderBy('sort_order')
            ->orderByDesc('is_featured')
            ->paginate(12);

        $notices = GroomingNotice::where('is_active', true)
            ->where('show_on_grooming', true)
            ->where(fn($q) => $q->whereNull('expires_at')->orWhere('expires_at', '>', now()))
            ->orderByRaw("FIELD(priority, 'critical', 'normal', 'low')")
            ->get();

        $settings = Setting::first();

        $selectedBatch = $this->batch_id
            ? GroomingBatch::find($this->batch_id)
            : null;

        return view('livewire.grooming-page', compact(
            'batches',
            'gallery',
            'notices',
            'settings',
            'selectedBatch'
        ));
    }
}