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
    public string $currentStep = 'profile';

    // ── NID Fields ──
    public $nidImage;
    public $nidBackImage;
    public $profilePhotoUpload = null;

    // ── Core User Fields ──
    public string $name = '';
    public string $email = '';
    public string $phone = '';

    // ── Profile Fields ──
    public string $gender = '';
    public string $date_of_birth = '';
    public $height_cm = '';
    public $hourly_rate = '';
    public string $languages = '';
    public string $country = 'Bangladesh';
    public string $district = '';
    public string $upazila = '';
    public string $street_address = '';
    public string $bio = '';
    public array $categories = [];

    // ── Media ──
    // REMOVED: public array $newPhotos = []; — replaced by sequential single-file uploads
    public $portfolioImages = [];
    public $newAvatar = null;
    public bool $saved = false;

    // ── NEW: Single-file sequential portfolio upload ──
    // This property receives ONE compressed file at a time from the JS queue.
    // The JS layer compresses client-side, then calls $wire.upload() per file.
    public $singlePortfolioPhoto = null;

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

    // ── Experiences ──
    public array $experiences = [];
    public string $newExpType = 'acting_screen';
    public string $newExpYear = '';
    public string $newExpTitle = '';
    public string $newExpRole = '';
    public string $newExpDirector = '';
    public string $newExpProduction = '';
    public string $newExpNotes = '';
    public string $newExpAwardCategory = '';
    public string $newExpAwardWork = '';
    public string $newExpAwardResult = 'Won';
    public string $newExpJuryLocation = '';
    public bool $showExpForm = false;
    public ?int $editingExpId = null;
    public string $newExpCustomType = '';
    public string $newExpDescription = '';
    public string $newExpLanguage = '';
    public string $newExpPlatform = '';
    public string $newExpAwardOrganizer = '';

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $subscription = $user->subscriptions()->latest()->first();

        if (!$subscription) {
            return redirect()->route('packages.index');
        } elseif ($subscription->status === 'failed') {
            $this->currentStep = 'payment_failed';
            return;
        } elseif ($subscription->status === 'expired') {
            $this->currentStep = 'payment_expired';
            return;
        }

        if (
            in_array($user->verification_status, ['unverified', 'rejected', null, ''], true) ||
            in_array($user->nid_back_verification_status, ['unverified', 'rejected', null, ''], true)
        ) {
            $this->currentStep = 'document_upload';
            return;
        }

        $profile = $user->profile;
        if (!$profile || empty($profile->district) || empty($profile->upazila)) {
            $this->currentStep = 'basic_info';
            $this->name = $user->name ?? '';
            $this->email = $user->email ?? '';
            $this->phone = $user->phone ?? '';
            if ($profile) {
                $this->gender = $profile->gender ?? '';
                $this->date_of_birth = $profile->date_of_birth ? $profile->date_of_birth->format('Y-m-d') : '';
                $this->height_cm = $profile->height_cm ?? '';
                $this->languages = $profile->languages ? implode(', ', (array) $profile->languages) : '';
                $this->experience_level = $profile->experience_level ?? '';
                $this->availability = $profile->availability ?? '';
                $this->district = $profile->district ?? '';
                $this->upazila = $profile->upazila ?? '';
                $this->street_address = $profile->street_address ?? '';
            }
            return;
        }

        if (
            $user->verification_status === 'pending' ||
            $user->nid_back_verification_status === 'pending' ||
            $subscription->status === 'pending'
        ) {
            $this->currentStep = 'under_review';
            return;
        }

        $this->currentStep = 'profile';
        $this->loadProfileData($user);
    }

    // ─────────────────────────────────────────────────────────────────────────
    // NEW: Sequential Single-File Portfolio Upload
    //
    // Called by the JS queue one file at a time AFTER client-side compression.
    // This replaces the old bulk `newPhotos` approach.
    //
    // Flow:
    //   1. User selects files in browser
    //   2. Alpine.js reads each File object into a queue
    //   3. For each file: Canvas API compresses it → creates a new Blob
    //   4. $wire.upload('singlePortfolioPhoto', blob, success, error, progress)
    //   5. On success callback → JS calls $wire.saveSinglePortfolioPhoto()
    //   6. This method moves the temp file into the media library
    //   7. Dispatches 'portfolio-photo-saved' event → JS marks that item done
    //   8. JS picks the next file from the queue and repeats
    // ─────────────────────────────────────────────────────────────────────────
    public function saveSinglePortfolioPhoto(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Enforce the 12-photo limit before doing any work
        $existingCount = $user->getMedia('portfolio')->count();
        if ($existingCount >= 12) {
            $this->reset('singlePortfolioPhoto');
            $this->dispatch('portfolio-upload-error', message: 'Maximum 12 photos reached.');
            return;
        }

        $this->validate([
            'singlePortfolioPhoto' => 'required|image|mimes:jpg,jpeg,png,webp|max:8192',
        ]);

        try {
            $photo = $this->singlePortfolioPhoto;

            $user->addMedia($photo->getRealPath())
                ->usingFileName(
                    pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME)
                    . '_' . time() . rand(100, 999)
                    . '.' . $photo->getClientOriginalExtension()
                )
                ->toMediaCollection('portfolio', 'public');

            $this->reset('singlePortfolioPhoto');

            // Refresh the thumbnail grid
            $this->portfolioImages = $user->fresh()->getMedia('portfolio');

            // Tell the JS queue this slot is done → move to next file
            $this->dispatch('portfolio-photo-saved');

        } catch (\Exception $e) {
            Log::error('saveSinglePortfolioPhoto failed for user ' . Auth::id() . ': ' . $e->getMessage());
            $this->reset('singlePortfolioPhoto');
            $this->dispatch('portfolio-upload-error', message: 'Upload failed. Please try again.');
        }
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Returns current portfolio count for the JS layer to enforce the cap
    // ─────────────────────────────────────────────────────────────────────────
    public function getPortfolioCount(): int
    {
        return Auth::user()->getMedia('portfolio')->count();
    }

    public function submitDocuments()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $rules = [];
        $updates = [];

        $needsNid = in_array($user->verification_status, ['unverified', 'rejected', null, ''], true);
        $needsAcademic = in_array($user->nid_back_verification_status, ['unverified', 'rejected', null, ''], true);

        if ($needsNid) {
            $rules['nidImage'] = 'required|image|mimes:jpg,jpeg,png,webp|max:5120';
        }
        if ($needsAcademic) {
            $rules['nidBackImage'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120';
        }
        $rules['profilePhotoUpload'] = 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072';

        $this->validate($rules);

        if ($this->nidImage) {
            $updates['nid_path'] = $this->nidImage->store('nids', 'private');
            $updates['verification_status'] = 'pending';
        }

        if ($this->nidBackImage) {
            $updates['nid_back_path'] = $this->nidBackImage->store('nid_back', 'private');
            $updates['nid_back_verification_status'] = 'pending';
        }

        if (empty($updates)) {
            $this->addError('nidImage', 'Please upload at least your NID/Passport image.');
            return;
        }

        $user->update($updates);

        if ($this->profilePhotoUpload) {
            $user->getMedia('avatar')->each->delete();
            $user->addMedia($this->profilePhotoUpload->getRealPath())
                ->usingFileName('avatar_' . $user->id . '.' . $this->profilePhotoUpload->getClientOriginalExtension())
                ->toMediaCollection('avatar', 'public');
        }

        $admins = User::role('Super-Admin')->get();

        try {
            Notification::send($admins, new AdminAlertNotification(
                'New Documents Uploaded',
                "{$user->name} has uploaded new verification documents.",
                'Review Documents',
                url('/admin/users')
            ));
        } catch (\Exception $e) {
            Log::error('Admin document notification failed: ' . $e->getMessage());
        }

        FilamentNotification::make()
            ->title('New Documents Uploaded 📄')
            ->body("{$user->name} just uploaded their NID/Academic certificates for review.")
            ->warning()
            ->sendToDatabase($admins);

        $subscription = $user->subscriptions()->latest()->first();

        if (!$subscription || in_array($subscription->status, ['failed', 'expired'])) {
            return redirect()->route('packages.index');
        }

        return redirect()->route('account.dashboard');
    }

    public function submitBasicInfo()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => "nullable|string|max:20|unique:users,phone,{$user->id}",
            'gender' => 'nullable|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date|before:today|after:1900-01-01',
            'height_cm' => 'nullable|string|max:20',
            'languages' => 'nullable|string|max:500',
            'experience_level' => 'nullable|in:Fresher,1-3 Years,Professional',
            'availability' => 'nullable|in:Full-time,Part-time,Weekends Only,Flexible',
            'district' => 'required|string|max:100',
            'upazila' => 'required|string|max:100',
            'street_address' => 'nullable|string|max:500',
            'categories' => 'required|array|min:1',
            'categories.*' => 'string|max:100',
        ]);

        $user->update([
            'name' => trim($this->name),
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
                'languages' => $languagesArray,
                'experience_level' => $this->experience_level ?: null,
                'availability' => $this->availability ?: null,
                'district' => $this->district,
                'upazila' => $this->upazila,
                'street_address' => $this->street_address ?: null,
            ]
        );

        return redirect()->route('account.dashboard');
    }

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

    public function deleteAvatar()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->getMedia('avatar')->each->delete();
        session()->flash('success', 'Profile picture removed.');
    }

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
            $this->street_address = $profile->street_address ?? '';
            $this->bio = $profile->bio ?? '';
            $this->languages = $profile->languages ? implode(', ', (array) $profile->languages) : '';
            $this->facebook_url = $profile->facebook_url ?? '';
            $this->instagram_url = $profile->instagram_url ?? '';
            $this->youtube_url = $profile->youtube_url ?? '';
            $this->tiktok_url = $profile->tiktok_url ?? '';
            $this->linkedin_url = $profile->linkedin_url ?? '';
            $this->portfolio_url = $profile->portfolio_url ?? '';
            $this->weight_kg = $profile->weight_kg ?? '';
            $this->chest_bust_inches = $profile->chest_bust_inches ?? '';
            $this->waist_inches = $profile->waist_inches ?? '';
            $this->hips_inches = $profile->hips_inches ?? '';
            $this->shoulder_inches = $profile->shoulder_inches ?? '';
            $this->shoe_size = $profile->shoe_size ?? '';
            $this->dress_size = $profile->dress_size ?? '';
            $this->skin_tone = $profile->skin_tone ?? '';
            $this->eye_color = $profile->eye_color ?? '';
            $this->hair_color = $profile->hair_color ?? '';
            $this->hair_length = $profile->hair_length ?? '';
            $this->experience_level = $profile->experience_level ?? '';
            $this->special_skills = $profile->special_skills ?? [];
            $this->showreel_url = $profile->showreel_url ?? '';
            $this->willing_to_travel = $profile->willing_to_travel ?? false;
            $this->availability = $profile->availability ?? '';
            $this->instagram_followers = $profile->instagram_followers ?? '';
            $this->tiktok_followers = $profile->tiktok_followers ?? '';
            $this->facebook_followers = $profile->facebook_followers ?? '';
        }

        $this->portfolioImages = $user->getMedia('portfolio');
        $this->loadExperiences($user);
    }

    public function saveProfile(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update(['last_active_at' => now()]);

        try {
            // NOTE: newPhotos is no longer validated here.
            // Portfolio uploads happen independently via saveSinglePortfolioPhoto().
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
                    'street_address' => $this->street_address ?: null,
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

    public function loadExperiences(User $user): void
    {
        $this->experiences = $user->experiences()->get()->toArray();
    }

    public function saveExperience(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'type' => $this->newExpType,
            'year' => $this->newExpYear ?: null,
            'title' => $this->newExpTitle,
            'role' => $this->newExpRole ?: null,
            'director' => $this->newExpDirector ?: null,
            'production' => $this->newExpProduction ?: null,
            'notes' => $this->newExpNotes ?: null,
            'award_category' => $this->newExpAwardCategory ?: null,
            'award_work' => $this->newExpAwardWork ?: null,
            'award_result' => $this->newExpAwardResult ?: null,
            'jury_location' => $this->newExpJuryLocation ?: null,
            'custom_type_label' => $this->newExpType === 'custom' ? $this->newExpCustomType : null,
            'description' => $this->newExpDescription ?: null,
            'language' => $this->newExpLanguage ?: null,
            'platform' => $this->newExpPlatform ?: null,
            'award_organizer' => $this->newExpAwardOrganizer ?: null,
        ];

        $this->validate([
            'newExpType' => 'required|in:acting_screen,modeling_fashion,photography_media,advertising_promotion,event_hosting,digital_content,competitions_pageants,awards_achievements,workshop_training,other,custom',
            'newExpCustomType' => 'required_if:newExpType,custom|nullable|string|max:100',
            'newExpTitle' => 'required|string|max:255',
            'newExpYear' => 'nullable|string|max:10',
            'newExpDescription' => 'nullable|string|max:1000',
            'newExpLanguage' => 'nullable|string|max:100',
            'newExpPlatform' => 'nullable|string|max:100',
            'newExpAwardOrganizer' => 'nullable|string|max:255',
        ]);

        if ($this->editingExpId) {
            \App\Models\ArtistExperience::where('id', $this->editingExpId)
                ->where('user_id', $user->id)
                ->update($data);
        } else {
            \App\Models\ArtistExperience::create($data);
        }

        $this->resetExpForm();
        $this->loadExperiences($user);
        session()->flash('message', 'Experience saved!');
    }

    public function editExperience(int $id): void
    {
        $exp = \App\Models\ArtistExperience::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $this->editingExpId = $exp->id;
        $this->newExpType = $exp->type;
        $this->newExpYear = $exp->year ?? '';
        $this->newExpTitle = $exp->title;
        $this->newExpRole = $exp->role ?? '';
        $this->newExpDirector = $exp->director ?? '';
        $this->newExpProduction = $exp->production ?? '';
        $this->newExpNotes = $exp->notes ?? '';
        $this->newExpAwardCategory = $exp->award_category ?? '';
        $this->newExpAwardWork = $exp->award_work ?? '';
        $this->newExpAwardResult = $exp->award_result ?? 'Won';
        $this->newExpJuryLocation = $exp->jury_location ?? '';
        $this->showExpForm = true;
        $this->newExpDescription = $exp->description ?? '';
        $this->newExpLanguage = $exp->language ?? '';
        $this->newExpPlatform = $exp->platform ?? '';
        $this->newExpAwardOrganizer = $exp->award_organizer ?? '';
        $this->newExpCustomType = $exp->custom_type_label ?? '';
    }

    public function deleteExperience(int $id): void
    {
        \App\Models\ArtistExperience::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadExperiences(Auth::user());
        session()->flash('message', 'Entry deleted.');
    }

    public function resetExpForm(): void
    {
        $this->editingExpId = null;
        $this->newExpType = 'acting_screen';
        $this->newExpYear = $this->newExpTitle = $this->newExpRole = '';
        $this->newExpDirector = $this->newExpProduction = $this->newExpNotes = '';
        $this->newExpAwardCategory = $this->newExpAwardWork = '';
        $this->newExpAwardResult = 'Won';
        $this->newExpJuryLocation = '';
        $this->showExpForm = false;
        $this->newExpCustomType = '';
        $this->newExpDescription = '';
        $this->newExpLanguage = '';
        $this->newExpPlatform = '';
        $this->newExpAwardOrganizer = '';
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $groupedCategories = \App\Models\Category::where('is_active', true)
            ->customOrdered()
            ->get()
            ->groupBy('group');

        return view('livewire.artist-account', [
            'user' => $user,
            'groupedCategories' => $groupedCategories,
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
            'categories.*' => 'string|max:100',

            'gender' => 'nullable|in:Male,Female,Other',
            'date_of_birth' => 'nullable|date|before:today|after:1900-01-01',

            'height_cm' => 'nullable|string|max:20',
            'weight_kg' => 'nullable|string|max:20',

            'hourly_rate' => 'nullable|numeric|min:0|max:999999',

            'languages' => 'nullable|string|max:500',

            'country' => 'nullable|string|max:100',
            'district' => 'required|string|max:100',
            'upazila' => 'required|string|max:100',
            'street_address' => 'nullable|string|max:500',

            'bio' => 'nullable|string|max:2000',

            'facebook_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'portfolio_url' => 'nullable|url|max:255',
            'showreel_url' => 'nullable|url|max:255',

            // NOTE: newPhotos rules removed — portfolio uploads are now handled
            // independently by saveSinglePortfolioPhoto() one file at a time.

            'chest_bust_inches' => 'nullable|string|max:20',
            'waist_inches' => 'nullable|string|max:20',
            'hips_inches' => 'nullable|string|max:20',
            'shoulder_inches' => 'nullable|string|max:20',
            'shoe_size' => 'nullable|string|max:20',
            'dress_size' => 'nullable|in:XS,S,M,L,XL,XXL',

            'skin_tone' => 'nullable|in:Fair,Medium,Dusky,Deep',
            'eye_color' => 'nullable|string|max:50',
            'hair_color' => 'nullable|string|max:50',
            'hair_length' => 'nullable|in:Bald,Short,Medium,Long',

            'experience_level' => 'nullable|in:Fresher,1-3 Years,Professional',
            'special_skills' => 'nullable|array',
            'special_skills.*' => 'string|max:100',
            'willing_to_travel' => 'boolean',
            'availability' => 'nullable|in:Full-time,Part-time,Weekends Only,Flexible',

            'instagram_followers' => 'nullable|integer|min:0|max:999999999',
            'tiktok_followers' => 'nullable|integer|min:0|max:999999999',
            'facebook_followers' => 'nullable|integer|min:0|max:999999999',
        ];
    }
}