<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminAlertNotification;

#[Layout('layouts.app')]
class ArtistAccount extends Component
{
    use WithFileUploads;

    // ── State Machine ──
    // Available steps: 'payment_pending', 'nid_upload', 'nid_pending', 'profile'
    public string $currentStep = 'profile';

    // ── NID Fields ──
    public $nidImage;
    public $academicImage;

    // ── Core User Fields ──
    public string $name = '';
    public string $email = '';
    public string $phone = '';

    // ── Profile Fields ──
    // public string $category = '';
    public string $gender = '';
    public string $date_of_birth = '';
    public $height_cm = '';
    public $hourly_rate = '';
    public string $languages = '';
    public string $country = 'Bangladesh';
    public string $district = '';
    public string $upazila = '';
    public string $bio = '';
    public array $categories = []; // Replaces the old string $category
    // public $groupedCategories;     // To hold the DB results

    // ── Media ──
    public array $newPhotos = [];
    public $portfolioImages = [];
    public $newAvatar = null;
    public bool $saved = false;
    // ── Social Links ──
    public string $facebook_url = '';
    public string $instagram_url = '';
    public string $youtube_url = '';
    public string $tiktok_url = '';
    public string $linkedin_url = '';
    public string $portfolio_url = '';

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $subscription = $user->subscriptions()->latest()->first();

        if (!$subscription) {
            return redirect()->route('packages.index');

        } elseif ($subscription->status === 'failed') {
            $this->currentStep = 'payment_failed';

        } elseif ($subscription->status === 'expired') {
            $this->currentStep = 'payment_expired';

        } elseif ($subscription->status === 'pending') {
            $this->currentStep = 'payment_pending';

        } elseif (
            in_array($user->verification_status, ['unverified', 'rejected']) ||
            in_array($user->academic_verification_status, ['unverified', 'rejected'])
        ) {
            // Any doc missing OR rejected → send to upload form
            $this->currentStep = 'document_upload';

        } elseif (
            $user->verification_status === 'pending' ||
            $user->academic_verification_status === 'pending'
        ) {
            // Both submitted, waiting on admin
            $this->currentStep = 'document_pending';

        } else {
            // Both verified → full access
            $this->currentStep = 'profile';
            $this->loadProfileData($user);
        }
    }

    public function submitDocuments()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $rules = [];
        $updates = [];

        // Only require upload for docs that are missing or rejected
        if (in_array($user->verification_status, ['unverified', 'rejected'])) {
            $rules['nidImage'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120';
        }
        if (in_array($user->academic_verification_status, ['unverified', 'rejected'])) {
            $rules['academicImage'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120';
        }

        $this->validate($rules);

        if ($this->nidImage) {
            $updates['nid_path'] = $this->nidImage->store('nids', 'private');
            $updates['verification_status'] = 'pending';
        }

        if ($this->academicImage) {
            $updates['academic_certificate_path'] = $this->academicImage->store('academic_certificates', 'private');
            $updates['academic_verification_status'] = 'pending';
        }

        if (!empty($updates)) {
            $user->update($updates);

            $admins = User::role('Super-Admin')->get();
            Notification::send($admins, new AdminAlertNotification(
                'New Documents Uploaded',
                "{$user->name} has uploaded new verification documents.",
                'Review Documents',
                url('/admin/users')
            ));
        }

        $this->currentStep = 'document_pending';
    }

    // In ArtistAccount.php - updateAvatar()
    public function updateAvatar()
    {
        $this->validate(['newAvatar' => 'image|max:3072']);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->getMedia('avatar')->each->delete();

        $user->addMedia($this->newAvatar->getRealPath())
            ->usingFileName('avatar_' . $user->id . '.' . $this->newAvatar->getClientOriginalExtension())
            ->toMediaCollection('avatar', 'public');

        $this->reset('newAvatar');
        session()->flash('success', 'Profile picture updated!');
    }

    // In ArtistAccount.php - deleteAvatar()
    public function deleteAvatar()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->getMedia('avatar')->each->delete();
        session()->flash('success', 'Profile picture removed.');
    }
    // ── PROFILE LOADING & SAVING LOGIC ──
    private function loadProfileData($user)
    {
        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';

        $profile = $user->profile;
        if ($profile) {
            $this->categories = $profile->categories ?? [];
            $this->gender = $profile->gender ?? '';
            $this->date_of_birth = $profile->date_of_birth instanceof \Carbon\Carbon
                ? $profile->date_of_birth->format('Y-m-d')
                : (is_string($profile->date_of_birth) ? $profile->date_of_birth : '');
            $this->height_cm = $profile->height_cm ?? '';
            $this->hourly_rate = $profile->hourly_rate ?? '';
            $this->country = $profile->country ?? 'Bangladesh';
            $this->district = $profile->district ?? '';
            $this->upazila = $profile->upazila ?? '';
            $this->bio = $profile->bio ?? '';
            $this->languages = $profile->languages ? implode(', ', (array) $profile->languages) : '';
            $this->facebook_url = $profile->facebook_url ?? '';
            $this->instagram_url = $profile->instagram_url ?? '';
            $this->youtube_url = $profile->youtube_url ?? '';
            $this->tiktok_url = $profile->tiktok_url ?? '';
            $this->linkedin_url = $profile->linkedin_url ?? '';
            $this->portfolio_url = $profile->portfolio_url ?? '';
        }

        $this->portfolioImages = $user->getMedia('portfolio');
    }

    public function saveProfile(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update(['last_active_at' => now()]);

        try {
            $this->validate();

            $user->update([
                'name' => trim($this->name),
                'email' => trim($this->email),
                'phone' => trim($this->phone) ?: null,
            ]);

            $languagesArray = $this->languages
                ? array_values(array_filter(array_map('trim', explode(',', $this->languages))))
                : null;

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'categories' => $this->categories,
                    'gender' => $this->gender ?: null,
                    'date_of_birth' => $this->date_of_birth ?: null,
                    'height_cm' => $this->height_cm ?: null,
                    'hourly_rate' => $this->hourly_rate ?: null,
                    'languages' => $languagesArray,
                    'country' => $this->country ?: null,
                    'district' => $this->district ?: null,
                    'upazila' => $this->upazila ?: null,
                    'bio' => $this->bio ?: null,
                    'facebook_url' => $this->facebook_url ?: null,
                    'instagram_url' => $this->instagram_url ?: null,
                    'youtube_url' => $this->youtube_url ?: null,
                    'tiktok_url' => $this->tiktok_url ?: null,
                    'linkedin_url' => $this->linkedin_url ?: null,
                    'portfolio_url' => $this->portfolio_url ?: null,
                ]
            );

            if (!empty($this->newPhotos)) {
                $existingCount = $user->getMedia('portfolio')->count();
                $allowedNew = max(0, 10 - $existingCount);
                $photosToAdd = array_slice($this->newPhotos, 0, $allowedNew);

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

            $this->portfolioImages = $user->fresh()->getMedia('portfolio');
            $this->saved = true;
            session()->flash('message', 'Profile saved successfully!');
            $this->dispatch('profile-saved');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('saveProfile failed for user ' . Auth::id() . ': ' . $e->getMessage());
            session()->flash('error', 'Something went wrong while saving. Please try again.');
        }
    }

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

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Fetch all active categories and group them locally
        $groupedCategories = \App\Models\Category::where('is_active', true)
            ->get()
            ->groupBy('group');

        return view('livewire.artist-account', [
            'user' => $user,
            'groupedCategories' => $groupedCategories, // Passed directly to the view!
        ]);
    }

    protected function rules(): array
    {
        $userId = Auth::id();
        return [
            'name' => 'required|string|max:255',
            'email' => "required|email|max:255|unique:users,email,{$userId}",
            'phone' => "nullable|string|max:20|unique:users,phone,{$userId}",
            'categories' => 'required|array|min:1',
            'categories.*' => 'string',
            'gender' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'height_cm' => 'nullable|numeric|min:50|max:300',
            'hourly_rate' => 'nullable|numeric|min:0',
            'languages' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'upazila' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:2000',
            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'newPhotos' => 'nullable|array|max:10',
            'newPhotos.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }
}