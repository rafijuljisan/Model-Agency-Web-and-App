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
use Filament\Notifications\Notification as FilamentNotification;

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

    // ── Measurements ──
    public $weight_kg = '';
    public $chest_bust_inches = '';
    public $waist_inches = '';
    public $hips_inches = '';
    public $shoulder_inches = '';
    public string $shoe_size = '';
    public string $dress_size = '';

    // ── Appearance ──
    public string $skin_tone = '';
    public string $eye_color = '';
    public string $hair_color = '';
    public string $hair_length = '';

    // ── Experience ──
    public string $experience_level = '';
    public array $special_skills = [];
    public string $showreel_url = '';
    public bool $willing_to_travel = false;
    public string $availability = '';

    // ── Social follower counts ──
    public $instagram_followers = '';
    public $tiktok_followers = '';
    public $facebook_followers = '';

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. FIRST GATE: Check if documents are missing, rejected, or empty (NULL)
        if (
            in_array($user->verification_status, ['unverified', 'rejected', null, ''], true) ||
            in_array($user->academic_verification_status, ['unverified', 'rejected', null, ''], true)
        ) {
            $this->currentStep = 'document_upload';
            return;
        }

        // 2. SECOND GATE: Documents are uploaded (Pending or Verified). Now check Payment.
        $subscription = $user->subscriptions()->latest()->first();

        if (!$subscription) {
            // Docs are uploaded, but no payment exists -> Redirect to packages
            return redirect()->route('packages.index');

        } elseif ($subscription->status === 'failed') {
            $this->currentStep = 'payment_failed';
            return;

        } elseif ($subscription->status === 'expired') {
            $this->currentStep = 'payment_expired';
            return;
        }

        // 3. THIRD GATE: Docs are (Pending or Verified) AND Payment is (Pending or Active).
        // If ANYTHING is still pending, show the combined "Under Review" screen.
        if (
            $user->verification_status === 'pending' ||
            $user->academic_verification_status === 'pending' ||
            $subscription->status === 'pending'
        ) {
            $this->currentStep = 'under_review';
            return;
        }

        // 4. FINAL GATE: Everything is verified and active -> Full Access
        $this->currentStep = 'profile';
        $this->loadProfileData($user);
    }

    public function submitDocuments()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $rules = [];
        $updates = [];

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
            
            // 1. Send Email (Your existing code)
            Notification::send($admins, new AdminAlertNotification(
                'New Documents Uploaded',
                "{$user->name} has uploaded new verification documents.",
                'Review Documents',
                url('/admin/users')
            ));

            // 2. Send Filament Panel Notification (NEW)
            FilamentNotification::make()
                ->title('New Documents Uploaded 📄')
                ->body("{$user->name} just uploaded their NID/Academic certificates for review.")
                ->warning() // Shows a yellow/orange icon
                ->sendToDatabase($admins);
        }

        // ── NEW LOGIC: Check if they already paid before redirecting ──
        $subscription = $user->subscriptions()->latest()->first();

        // If they have no subscription, or it failed/expired, send them to pay
        if (!$subscription || in_array($subscription->status, ['failed', 'expired'])) {
            return redirect()->route('packages.index');
        }

        // If they already paid (status is pending or active), reload the dashboard.
        // The mount() method will catch them and put them in the 'under_review' gate!
        return redirect()->route('account.dashboard');
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
            // Measurements
            $this->weight_kg = $profile->weight_kg ?? '';
            $this->chest_bust_inches = $profile->chest_bust_inches ?? '';
            $this->waist_inches = $profile->waist_inches ?? '';
            $this->hips_inches = $profile->hips_inches ?? '';
            $this->shoulder_inches = $profile->shoulder_inches ?? '';
            $this->shoe_size = $profile->shoe_size ?? '';
            $this->dress_size = $profile->dress_size ?? '';

            // Appearance
            $this->skin_tone = $profile->skin_tone ?? '';
            $this->eye_color = $profile->eye_color ?? '';
            $this->hair_color = $profile->hair_color ?? '';
            $this->hair_length = $profile->hair_length ?? '';

            // Experience
            $this->experience_level = $profile->experience_level ?? '';
            $this->special_skills = $profile->special_skills ?? [];
            $this->showreel_url = $profile->showreel_url ?? '';
            $this->willing_to_travel = $profile->willing_to_travel ?? false;
            $this->availability = $profile->availability ?? '';

            // Follower counts
            $this->instagram_followers = $profile->instagram_followers ?? '';
            $this->tiktok_followers = $profile->tiktok_followers ?? '';
            $this->facebook_followers = $profile->facebook_followers ?? '';
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
                    'weight_kg' => $this->weight_kg ?: null,
                    'chest_bust_inches' => $this->chest_bust_inches ?: null,
                    'waist_inches' => $this->waist_inches ?: null,
                    'hips_inches' => $this->hips_inches ?: null,
                    'shoulder_inches' => $this->shoulder_inches ?: null,
                    'shoe_size' => $this->shoe_size ?: null,
                    'dress_size' => $this->dress_size ?: null,
                    'skin_tone' => $this->skin_tone ?: null,
                    'eye_color' => $this->eye_color ?: null,
                    'hair_color' => $this->hair_color ?: null,
                    'hair_length' => $this->hair_length ?: null,
                    'experience_level' => $this->experience_level ?: null,
                    'special_skills' => !empty($this->special_skills) ? $this->special_skills : null,
                    'showreel_url' => $this->showreel_url ?: null,
                    'willing_to_travel' => $this->willing_to_travel,
                    'availability' => $this->availability ?: null,
                    'instagram_followers' => $this->instagram_followers ?: null,
                    'tiktok_followers' => $this->tiktok_followers ?: null,
                    'facebook_followers' => $this->facebook_followers ?: null,
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
            'weight_kg' => 'nullable|numeric|min:20|max:300',
            'chest_bust_inches' => 'nullable|numeric|min:20|max:80',
            'waist_inches' => 'nullable|numeric|min:20|max:80',
            'hips_inches' => 'nullable|numeric|min:20|max:80',
            'shoulder_inches' => 'nullable|numeric|min:10|max:60',
            'shoe_size' => 'nullable|string|max:20',
            'dress_size' => 'nullable|string|max:10',
            'skin_tone' => 'nullable|string|max:50',
            'eye_color' => 'nullable|string|max:50',
            'hair_color' => 'nullable|string|max:50',
            'hair_length' => 'nullable|string|max:20',
            'experience_level' => 'nullable|string|max:50',
            'special_skills' => 'nullable|array',
            'special_skills.*' => 'string|max:100',
            'showreel_url' => 'nullable|url|max:255',
            'willing_to_travel' => 'boolean',
            'availability' => 'nullable|string|max:50',
            'instagram_followers' => 'nullable|integer|min:0',
            'tiktok_followers' => 'nullable|integer|min:0',
            'facebook_followers' => 'nullable|integer|min:0',
        ];
    }
}