<?php

namespace App\Livewire;

use App\Models\GroomingApplication;
use App\Models\GroomingBatch;
use App\Models\GroomingGallery;
use App\Models\GroomingNotice;
use App\Models\Setting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Grooming Class | Dhaka Model Agency')]
#[Layout('layouts.app')]
class GroomingPage extends Component
{
    use WithFileUploads, WithPagination;

    // ── Multi-step state ──
    public int $step = 1;
    public int $totalSteps = 5;

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
    public string $transaction_id = '';
    public $payment_screenshot = null;

    // ── UI ──
    public bool $submitted = false;
    public ?int $applicationId = null;

    // ── Validation rules per step ──
    protected function rulesForStep(): array
    {
        return match ($this->step) {
            1 => [
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'whatsapp' => 'nullable|string|max:20',
                'email' => 'nullable|email|max:255',
            ],
            2 => [
                'age' => 'nullable|integer|min:10|max:60',
                'gender' => 'nullable|in:Male,Female,Other',
                'height' => 'nullable|string|max:20',
                'weight' => 'nullable|string|max:20',
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
                'payment_method' => 'required|string',
                'transaction_id' => 'required|string|unique:grooming_applications,transaction_id',
                'payment_screenshot' => 'nullable|image|max:3072',
            ],
            default => [],
        };
    }

    public function nextStep(): void
    {
        $this->validate($this->rulesForStep());
        $this->step++;
    }

    public function prevStep(): void
    {
        $this->step = max(1, $this->step - 1);
    }

    public function submit(): void
    {
        $this->validate($this->rulesForStep());

        // Save screenshot
        $screenshotPath = null;
        if ($this->payment_screenshot) {
            $screenshotPath = $this->payment_screenshot->store('grooming/payments', 'public');
        }

        $application = GroomingApplication::create([
            'batch_id' => $this->batch_id,
            'full_name' => $this->full_name,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp ?: null,
            'email' => $this->email ?: null,
            'age' => $this->age ?: null,
            'gender' => $this->gender ?: null,
            'height' => $this->height ?: null,
            'weight' => $this->weight ?: null,
            'address' => $this->address ?: null,
            'career_interests' => !empty($this->career_interests) ? $this->career_interests : null,
            'experience_level' => $this->experience_level ?: null,
            'payment_method' => $this->payment_method,
            'transaction_id' => $this->transaction_id,
            'payment_screenshot' => $screenshotPath,
            'status' => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Increment filled_seats on the batch
        GroomingBatch::where('id', $this->batch_id)->increment('filled_seats');

        $this->applicationId = $application->id;
        $this->submitted = true;
    }

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
            ->get(); // <-- Changed to get()

        $settings = Setting::first();

        $selectedBatch = $this->batch_id
            ? GroomingBatch::find($this->batch_id)
            : null;

        return view('livewire.grooming-page', compact(
            'batches',
            'gallery',
            'notices',
            'settings',
            'selectedBatch' // <-- Changed 'notice' to 'notices'
        ));
    }
}