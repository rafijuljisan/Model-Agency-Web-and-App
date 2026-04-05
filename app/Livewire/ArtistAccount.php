<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ArtistAccount extends Component
{
    use WithFileUploads;

    // ── Core User Fields ──
    public string $name     = '';
    public string $email    = '';
    public string $phone    = '';

    // ── Profile Fields ──
    public string $category      = '';
    public string $gender        = '';
    public string $date_of_birth = '';
    public        $height_cm     = '';
    public        $hourly_rate   = '';
    public string $languages     = '';
    public string $country       = 'Bangladesh';
    public string $district      = '';
    public string $upazila       = '';
    public string $bio           = '';

    // ── Media ──
    public array $newPhotos      = [];
    public       $portfolioImages = [];

    // ── UI State ──
    public bool $saved = false;

    // ─────────────────────────────────────────
    // MOUNT — load existing data
    // ─────────────────────────────────────────
    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->name  = $user->name  ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';

        $profile = $user->profile;
        if ($profile) {
            $this->category      = $profile->category      ?? '';
            $this->gender        = $profile->gender        ?? '';
            $this->date_of_birth = $profile->date_of_birth instanceof \Carbon\Carbon
                ? $profile->date_of_birth->format('Y-m-d')
                : (is_string($profile->date_of_birth) ? $profile->date_of_birth : '');
            $this->height_cm     = $profile->height_cm    ?? '';
            $this->hourly_rate   = $profile->hourly_rate  ?? '';
            $this->country       = $profile->country      ?? 'Bangladesh';
            $this->district      = $profile->district     ?? '';
            $this->upazila       = $profile->upazila      ?? '';
            $this->bio           = $profile->bio           ?? '';
            $this->languages     = $profile->languages
                                    ? implode(', ', (array) $profile->languages)
                                    : '';
        }

        $this->portfolioImages = $user->getMedia('portfolio');
    }

    // ─────────────────────────────────────────
    // VALIDATION RULES
    // ─────────────────────────────────────────
    protected function rules(): array
    {
        $userId = Auth::id();

        return [
            'name'          => 'required|string|max:255',
            'email'         => "required|email|max:255|unique:users,email,{$userId}",
            'phone'         => "nullable|string|max:20|unique:users,phone,{$userId}",
            'category'      => 'required|string',
            'gender'        => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'height_cm'     => 'nullable|numeric|min:50|max:300',
            'hourly_rate'   => 'nullable|numeric|min:0',
            'languages'     => 'nullable|string|max:255',
            'country'       => 'nullable|string|max:100',
            'district'      => 'nullable|string|max:100',
            'upazila'       => 'nullable|string|max:100',
            'bio'           => 'nullable|string|max:2000',
            'newPhotos'     => 'nullable|array|max:10',
            'newPhotos.*'   => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    protected function messages(): array
    {
        return [
            'name.required'        => 'Full name is required.',
            'email.required'       => 'Email address is required.',
            'email.unique'         => 'This email is already taken.',
            'phone.unique'         => 'This phone number is already registered.',
            'category.required'    => 'Please select your talent category.',
            'newPhotos.*.image'    => 'Each file must be a valid image.',
            'newPhotos.*.max'      => 'Each image must be under 5MB.',
            'newPhotos.max'        => 'You can upload a maximum of 10 photos.',
            'height_cm.numeric'    => 'Height must be a number.',
            'hourly_rate.numeric'  => 'Rate must be a number.',
        ];
    }

    // ─────────────────────────────────────────
    // REAL-TIME VALIDATION
    // ─────────────────────────────────────────
    public function updated(string $field): void
    {
        $this->validateOnly($field);
    }

    // ─────────────────────────────────────────
    // SAVE PROFILE
    // ─────────────────────────────────────────
    public function saveProfile(): void
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // TEMPORARY DEBUGGING: Catch validation explicitly
    try {
        $this->validate();
    } catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->errors()); // This will pause execution and show you exactly what is failing!
    }

        try {
            $this->validate();

            // 1. Update core user
            $user->update([
                'name'  => trim($this->name),
                'email' => trim($this->email),
                'phone' => trim($this->phone) ?: null,
            ]);

            // 2. Parse languages into array
            $languagesArray = $this->languages
                ? array_values(array_filter(array_map('trim', explode(',', $this->languages))))
                : null;

            // 3. Save/update profile
            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'category'      => $this->category,
                    'gender'        => $this->gender        ?: null,
                    'date_of_birth' => $this->date_of_birth ?: null,
                    'height_cm'     => $this->height_cm     ?: null,
                    'hourly_rate'   => $this->hourly_rate   ?: null,
                    'languages'     => $languagesArray,
                    'country'       => $this->country       ?: null,
                    'district'      => $this->district      ?: null,
                    'upazila'       => $this->upazila       ?: null,
                    'bio'           => $this->bio            ?: null,
                ]
            );

            // 4. Handle portfolio uploads
            if (!empty($this->newPhotos)) {
                // Enforce max 10 total across existing + new
                $existingCount = $user->getMedia('portfolio')->count();
                $allowedNew    = max(0, 10 - $existingCount);
                $photosToAdd   = array_slice($this->newPhotos, 0, $allowedNew);

                foreach ($photosToAdd as $photo) {
                    $user->addMedia($photo->getRealPath())
                         ->usingName($photo->getClientOriginalName())
                         ->usingFileName(
                             pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)
                             . '_' . time() . '.' . $photo->getClientOriginalExtension()
                         )
                         ->toMediaCollection('portfolio', 'public');
                }

                $this->newPhotos = [];
            }

            // 5. Refresh portfolio thumbnail list
            $this->portfolioImages = $user->fresh()->getMedia('portfolio');

            // 6. Mark as saved
            $this->saved = true;
            session()->flash('message', 'Profile saved successfully!');
            $this->dispatch('profile-saved');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Let Livewire handle field-level errors normally
            throw $e;

        } catch (\Exception $e) {
            Log::error('saveProfile failed for user ' . Auth::id() . ': ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while saving. Please try again.');
        }
    }

    // ─────────────────────────────────────────
    // DELETE PHOTO
    // ─────────────────────────────────────────
    public function deletePhoto(int $mediaId): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $media = $user->getMedia('portfolio')->find($mediaId);

        if (!$media) {
            session()->flash('error', 'Photo not found or already deleted.');
            return;
        }

        try {
            $media->delete();
            $this->portfolioImages = $user->fresh()->getMedia('portfolio');
            session()->flash('message', 'Photo removed successfully.');
        } catch (\Exception $e) {
            Log::error('deletePhoto failed: ' . $e->getMessage());
            session()->flash('error', 'Could not delete photo. Please try again.');
        }
    }

    // ─────────────────────────────────────────
    // RENDER
    // ─────────────────────────────────────────
    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $hasActiveSub = $user->subscriptions()->where('status', 'active')->exists();

        return view('livewire.artist-account', [
            'user'            => $user,
            'isVerified'      => $user->hasRole('Verified-Artist') && $hasActiveSub,
            'hasActiveSub'    => $hasActiveSub,
            'portfolioImages' => $this->portfolioImages,
        ]); // <-- REMOVED the chained layout method here
    }
}