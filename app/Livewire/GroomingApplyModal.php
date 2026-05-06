<?php

// Path: app/Livewire/GroomingApplyModal.php

namespace App\Livewire;

use App\Models\GroomingApplication;
use App\Models\GroomingBatch;
use App\Models\Setting;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

class GroomingApplyModal extends Component
{
    use WithFileUploads;

    // ── Modal visibility (controlled via Alpine from parent) ──
    // Parent pages dispatch 'open-grooming-modal' browser event

    // ── Step state ──
    public int  $step       = 0;
    public int  $totalSteps = 5;
    public bool $submitted  = false;
    public ?string $applicationId = null;

    // ── Step 0: Member lookup ──
    public bool    $isMemberCheck     = false;
    public bool    $isPreFilled       = false;
    public string  $memberLookupInput = '';
    public ?string $memberLookupError = null;

    // ── Batch data ──
    public ?string $batch_id = null;
    public $batches;
    public $settings;

    // ── Step 1: Personal info ──
    public string $full_name = '';
    public string $phone     = '';
    public string $whatsapp  = '';
    public string $email     = '';

    // ── Step 2: Physical info ──
    public ?int   $age     = null;
    public string $gender  = '';
    public string $height  = '';
    public string $weight  = '';
    public string $address = '';

    // ── Step 3: Career interests ──
    public array  $career_interests = [];
    public string $experience_level = '';

    // ── Step 5: Payment ──
    public string $payment_method    = '';
    public string $sender_number     = '';
    public string $transaction_id    = '';
    public        $payment_screenshot;

    // ─────────────────────────────────────────
    // MOUNT
    // ─────────────────────────────────────────
    public function mount(?string $batchId = null): void
    {
        $this->batch_id = $batchId;

        $this->batches = GroomingBatch::where('is_active', true)
            ->where('status', '!=', 'full')
            ->orderBy('start_date')
            ->get();

        $this->settings = Setting::first();
    }

    // ─────────────────────────────────────────
    // COMPUTED: selected batch
    // ─────────────────────────────────────────
    public function getSelectedBatchProperty(): ?GroomingBatch
    {
        if (! $this->batch_id) return null;

        return $this->batches->firstWhere('id', $this->batch_id)
            ?? GroomingBatch::find($this->batch_id);
    }

    // ─────────────────────────────────────────
    // STEP 0: Member lookup
    // ─────────────────────────────────────────
    public function lookupMember(): void
    {
        $this->memberLookupError = null;

        $this->validate(
            ['memberLookupInput' => 'required|min:3'],
            ['memberLookupInput.required' => 'Please enter your Member ID or phone number.']
        );

        $input = trim($this->memberLookupInput);

        $user = User::where('member_id', $input)
            ->orWhere('phone', $input)
            ->first();

        if (! $user) {
            $this->memberLookupError = 'No verified member found with that ID or phone. Please check and try again.';
            return;
        }

        // Pre-fill from profile
        $this->full_name = $user->name ?? '';
        $this->phone     = $user->phone ?? '';
        $this->email     = $user->email ?? '';
        $this->whatsapp  = $user->profile?->whatsapp ?? $user->phone ?? '';
        $this->age       = $user->profile?->age;
        $this->gender    = $user->profile?->gender ?? '';
        $this->height    = $user->profile?->height ?? '';
        $this->weight    = $user->profile?->weight ?? '';
        $this->address   = $user->profile?->address ?? '';

        $this->isPreFilled = true;
        $this->step = 3;
    }

    public function skipMemberLookup(): void
    {
        if ($this->isMemberCheck) {
            $this->isMemberCheck = false;
        } else {
            $this->step = 1;
        }
        $this->memberLookupError = null;
        $this->memberLookupInput = '';
    }

    // ─────────────────────────────────────────
    // NAVIGATION
    // ─────────────────────────────────────────
    public function nextStep(): void
    {
        $this->validateCurrentStep();
        $this->step++;
    }

    public function prevStep(): void
    {
        // If pre-filled member, going back from step 3 returns to step 0
        if ($this->isPreFilled && $this->step === 3) {
            $this->step        = 0;
            $this->isPreFilled = false;
            $this->isMemberCheck = false;
            return;
        }

        $this->step = max(1, $this->step - 1);
    }

    private function validateCurrentStep(): void
    {
        match ($this->step) {
            1 => $this->validate([
                'full_name' => 'required|min:2|max:100',
                'phone'     => 'required|min:10|max:15',
                'email'     => 'nullable|email|max:100',
            ], [
                'full_name.required' => 'Full name is required.',
                'phone.required'     => 'Mobile number is required.',
                'email.email'        => 'Please enter a valid email address.',
            ]),

            2 => $this->validate([
                'age'    => 'nullable|integer|min:14|max:65',
                'gender' => 'nullable|string|max:20',
                'height' => 'nullable|string|max:30',
                'weight' => 'nullable|string|max:30',
            ], [
                'age.min' => 'Minimum age is 14.',
                'age.max' => 'Maximum age is 65.',
            ]),

            3 => $this->validate([
                'career_interests' => 'nullable|array|max:10',
                'experience_level' => 'nullable|string',
            ]),

            4 => $this->validate([
                'batch_id' => 'required',
            ], [
                'batch_id.required' => 'Please select a batch to continue.',
            ]),

            default => null,
        };
    }

    // ─────────────────────────────────────────
    // SUBMIT
    // ─────────────────────────────────────────
    public function submit(): void
    {
        $this->validate([
            'payment_method'     => 'required',
            'sender_number'      => 'required|min:10|max:15',
            'transaction_id'     => 'required|min:4|max:50',
            'payment_screenshot' => 'nullable|image|max:3072',
        ], [
            'payment_method.required'  => 'Please select a payment method.',
            'sender_number.required'   => 'Sender number is required.',
            'transaction_id.required'  => 'Transaction ID is required.',
            'payment_screenshot.image' => 'Screenshot must be an image file.',
            'payment_screenshot.max'   => 'Screenshot must be under 3MB.',
        ]);

        try {
            $screenshotPath = null;
            if ($this->payment_screenshot) {
                $screenshotPath = $this->payment_screenshot->store(
                    'grooming/payments', 'public'
                );
            }

            $application = GroomingApplication::create([
                'batch_id'           => $this->batch_id,
                'full_name'          => $this->full_name,
                'phone'              => $this->phone,
                'whatsapp'           => $this->whatsapp ?: $this->phone,
                'email'              => $this->email,
                'age'                => $this->age,
                'gender'             => $this->gender,
                'height'             => $this->height,
                'weight'             => $this->weight,
                'address'            => $this->address,
                'career_interests'   => $this->career_interests,
                'experience_level'   => $this->experience_level,
                'payment_method'     => $this->payment_method,
                'sender_number'      => $this->sender_number,
                'transaction_id'     => $this->transaction_id,
                'payment_screenshot' => $screenshotPath,
                'is_prefilled'       => $this->isPreFilled,
                'status'             => 'pending',
            ]);

            $appNumber = 'GRM-' . str_pad($application->id, 6, '0', STR_PAD_LEFT);
            $application->update(['application_number' => $appNumber]);

            // Increment filled seats on the batch
            GroomingBatch::where('id', $this->batch_id)->increment('filled_seats');

            $this->applicationId = $appNumber;
            $this->submitted     = true;

        } catch (\Throwable $e) {
            Log::error('GroomingApplyModal submit failed', [
                'error' => $e->getMessage(),
                'batch' => $this->batch_id,
                'phone' => $this->phone,
            ]);

            $this->addError('submit', 'Something went wrong. Please try again or contact us directly.');
        }
    }

    // ─────────────────────────────────────────
    // RESET (called when modal closes)
    // ─────────────────────────────────────────
    public function resetModal(): void
    {
        $this->reset([
            'step', 'submitted', 'applicationId',
            'isMemberCheck', 'isPreFilled', 'memberLookupInput', 'memberLookupError',
            'full_name', 'phone', 'whatsapp', 'email',
            'age', 'gender', 'height', 'weight', 'address',
            'career_interests', 'experience_level',
            'payment_method', 'sender_number', 'transaction_id', 'payment_screenshot',
        ]);
        // Keep batch_id if it was preselected from a show page
    }

    // ─────────────────────────────────────────
    // RENDER
    // ─────────────────────────────────────────
    public function render()
    {
        return view('livewire.grooming-apply-modal');
    }
}
