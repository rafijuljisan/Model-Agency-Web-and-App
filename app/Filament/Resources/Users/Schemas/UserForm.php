<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 1. Core User Account Details (Belongs to User Model)
                Section::make('Account Details')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->collection('avatar')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->imageAspectRatio('1:1')
                            ->automaticallyCropImagesToAspectRatio()
                            ->automaticallyResizeImagesToWidth(400)
                            ->automaticallyResizeImagesToHeight(400)
                            ->columnSpanFull()
                            ->helperText('Square image recommended. Max 3MB.'),

                        TextInput::make('member_id')
                            ->label('Member ID')
                            ->disabled()
                            ->dehydrated(false)
                            ->helperText('Auto-generated (e.g., DMA-261001)'),

                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true)
                            ->autocomplete('off'),

                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable(),

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),

                        Toggle::make('is_verified')
                            ->label('Verified Artist Badge')
                            ->columnSpanFull(),

                        Toggle::make('is_featured')
                            ->label('Feature on Homepage')
                            ->helperText('Override the algorithm and force this talent to the top of the homepage. Max 8 slots.')
                            ->live()
                            ->afterStateUpdated(function ($state, $set, $record) {
                                if ($state === true) {
                                    $currentCount = \App\Models\User::where('is_featured', true)
                                        ->when($record?->id, fn($q) => $q->where('id', '!=', $record->id))
                                        ->count();

                                    if ($currentCount >= 8) {
                                        $set('is_featured', false); // revert the toggle

                                        \Filament\Notifications\Notification::make()
                                            ->title('Featured Slots Full')
                                            ->body('All 8 featured slots are taken. Please unfeature another artist first.')
                                            ->danger()
                                            ->persistent()
                                            ->send();
                                    }
                                }
                            })
                            ->columnSpanFull(),
                    ]),

                // ==========================================
                // PROFILE RELATIONSHIP WRAPPER
                // Everything inside here saves to the `profiles` table
                // ==========================================
                Group::make()
                    ->relationship('profile')
                    ->schema([

                        // 2. Public Profile Information
                        Section::make('Public Profile Information')
                            ->columns(2)
                            ->schema([
                                Select::make('categories')
                                    ->label('Talent Categories & Skills')
                                    ->options(function (?\Illuminate\Database\Eloquent\Model $record) {
                                        // 1. Fetch categories using a custom priority sort for the group, then alphabetically by name
                                        $options = \App\Models\Category::customOrdered()
                                            ->get()
                                            ->mapWithKeys(fn($category) => [
                                                $category->name => "{$category->name} — ({$category->group})"
                                            ])
                                            ->toArray();

                                        // 2. Preserve archived/deleted categories for legacy profiles
                                        $savedCategories = [];
                                        if ($record) {
                                            if (isset($record->categories) && is_array($record->categories)) {
                                                $savedCategories = $record->categories;
                                            } elseif (isset($record->profile->categories) && is_array($record->profile->categories)) {
                                                $savedCategories = $record->profile->categories;
                                            }
                                        }

                                        foreach ($savedCategories as $category) {
                                            if (!array_key_exists($category, $options)) {
                                                $options[$category] = $category . ' (Archived/Deleted)';
                                            }
                                        }

                                        return $options;
                                    })
                                    ->multiple()
                                    ->searchable()
                                    ->preload()
                                    ->columnSpanFull()
                                    ->helperText('Select all areas where this talent has professional experience.'),

                                Select::make('gender')
                                    ->options([
                                        'Male' => 'Male',
                                        'Female' => 'Female',
                                        'Other' => 'Other',
                                    ]),

                                DatePicker::make('date_of_birth')
                                    ->label('Date of Birth'),

                                TextInput::make('hourly_rate')
                                    ->label('Starting Rate (BDT)')
                                    ->numeric()
                                    ->prefix('৳'),

                                TagsInput::make('languages')
                                    ->placeholder('e.g. English, Hindi, Bengali')
                                    ->label('Languages Spoken'),

                                TextInput::make('country')
                                    ->label('Country')
                                    ->default('Bangladesh'),

                                TextInput::make('district')
                                    ->autocomplete('off')
                                    ->label('District'),

                                TextInput::make('upazila')
                                    ->autocomplete('off')
                                    ->label('Thana / Upazila'),

                                TextInput::make('street_address')
                                    ->label('Street / Full Address (Private)')
                                    ->helperText('Never shown publicly. For internal use only.')
                                    ->autocomplete('off')
                                    ->columnSpanFull(),
                                Textarea::make('bio')
                                    ->label('About Me (Bio)')
                                    ->columnSpanFull()
                                    ->autocomplete('off')
                                    ->rows(4),
                            ]),

                        // 3. Measurements & Appearance
                        Section::make('Measurements & Appearance')
                            ->columns(4)
                            ->schema([
                                TextInput::make('height_cm')
                                    ->label('Height')
                                    ->placeholder("e.g. 5'10\" or 170cm")
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                TextInput::make('weight_kg')
                                    ->label('Weight (kg)')
                                    ->placeholder('e.g. 65 or 65.5')
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                TextInput::make('chest_bust_inches')
                                    ->label('Chest / Bust (in)')
                                    ->placeholder('e.g. 36 or 36.5')
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                TextInput::make('waist_inches')
                                    ->label('Waist (in)')
                                    ->placeholder('e.g. 30 or 30.5')
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                TextInput::make('hips_inches')
                                    ->label('Hips (in)')
                                    ->placeholder('e.g. 38 or 38.5')
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                TextInput::make('shoulder_inches')
                                    ->label('Shoulder (in) — Male')
                                    ->placeholder('e.g. 18 or 18.5')
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                TextInput::make('shoe_size')
                                    ->label('Shoe Size')
                                    ->placeholder('e.g. EU 42 / UK 8')
                                    ->autocomplete('off')
                                    ->maxLength(20),

                                Select::make('dress_size')
                                    ->label('Dress Size')
                                    ->options([
                                        'XS' => 'XS',
                                        'S' => 'S',
                                        'M' => 'M',
                                        'L' => 'L',
                                        'XL' => 'XL',
                                        'XXL' => 'XXL',
                                    ]),

                                Select::make('skin_tone')
                                    ->label('Skin Tone')
                                    ->allowHtml()
                                    ->native(false)
                                    ->options([
                                        'Fair'     => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #FCE3CD;"></span>Fair</div>',
                                        'Light'    => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #EED3BB;"></span>Light</div>',
                                        'Wheatish' => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #E2B88F;"></span>Wheatish</div>',
                                        'Dusky'    => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #C29587;"></span>Dusky</div>',
                                        'Deep'     => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #7C4D31;"></span>Deep</div>',
                                    ]),

                                Select::make('eye_color')
                                    ->label('Eye Color')
                                    ->searchable()
                                    ->allowHtml()
                                    ->native(false)
                                    ->options([
                                        'Brown'           => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #5c3817;"></span>Brown</div>',
                                        'Blue'            => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #4f7b98;"></span>Blue</div>',
                                        'Green'           => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #607228;"></span>Green</div>',
                                        'Greenish Blue'   => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #588383;"></span>Greenish Blue</div>',
                                        'Yellowish Green' => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #728224;"></span>Yellowish Green</div>',
                                        'Amber'           => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #8f7422;"></span>Amber</div>',
                                        'Hazel'           => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #986121;"></span>Hazel</div>',
                                        'Deep Blue'       => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #274f68;"></span>Deep Blue</div>',
                                        'Dark Green'      => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #3c561b;"></span>Dark Green</div>',
                                        'Freckled Hazel'  => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #704e22;"></span>Freckled Hazel</div>',
                                        'Greyish Blue'    => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #6e7e85;"></span>Greyish Blue</div>',
                                        'Forest Green'    => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #465521;"></span>Forest Green</div>',
                                        'Dark Hazel'      => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #593c15;"></span>Dark Hazel</div>',
                                        'Grey'            => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #727a7c;"></span>Grey</div>',
                                        'Spring Green'    => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded-full border border-gray-300 shadow-sm" style="background-color: #6d7d24;"></span>Spring Green</div>',
                                    ]),

                                Select::make('hair_color')
                                    ->label('Hair Color')
                                    ->searchable()
                                    ->allowHtml()
                                    ->native(false)
                                    ->options([
                                        'Black'         => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #111111;"></span>Black</div>',
                                        'Brown Black'   => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #221612;"></span>Brown Black</div>',
                                        'Darkest Brown' => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #342015;"></span>Darkest Brown</div>',
                                        'Dark Brown'    => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #46291b;"></span>Dark Brown</div>',
                                        'Medium Brown'  => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #5e3a26;"></span>Medium Brown</div>',
                                        'Light Brown'   => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #805338;"></span>Light Brown</div>',
                                        'Dark Blonde'   => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #b08868;"></span>Dark Blonde</div>',
                                        'Medium Blonde' => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #d1a77e;"></span>Medium Blonde</div>',
                                        'Light Blonde'  => '<div class="flex items-center gap-2"><span class="w-4 h-4 rounded border border-gray-300 shadow-sm" style="background-color: #e4c7a7;"></span>Light Blonde</div>',
                                    ]),

                                Select::make('hair_length')
                                    ->label('Hair Length')
                                    ->options([
                                        'Bald' => 'Bald',
                                        'Short' => 'Short',
                                        'Medium' => 'Medium',
                                        'Long' => 'Long',
                                    ]),
                            ]),

                        // 4. Experience & Skills
                        Section::make('Experience & Special Skills')
                            ->columns(2)
                            ->schema([
                                Select::make('experience_level')
                                    ->label('Experience Level')
                                    ->options([
                                        'Fresher' => 'Fresher (No Experience)',
                                        '1-3 Years' => '1–3 Years',
                                        'Professional' => 'Professional (3+ Years)',
                                    ]),

                                Select::make('availability')
                                    ->label('Availability')
                                    ->options([
                                        'Full-time' => 'Full-time',
                                        'Part-time' => 'Part-time',
                                        'Weekends' => 'Weekends Only',
                                        'Flexible' => 'Flexible',
                                    ]),

                                TagsInput::make('special_skills')
                                    ->label('Special Skills')
                                    ->placeholder('e.g. Driving, Swimming, Dancing')
                                    ->helperText('Press Enter after each skill')
                                    ->columnSpanFull(),

                                Toggle::make('willing_to_travel')
                                    ->label('Willing to Travel for Projects'),

                                TextInput::make('showreel_url')
                                    ->label('Intro Video / Showreel URL')
                                    ->url()
                                    ->placeholder('https://youtube.com/watch?v=...')
                                    ->helperText('YouTube or Vimeo link'),
                            ]),

                        // 5. Social Media & Follower Counts
                        Section::make('Social Media & Follower Counts')
                            ->columns(2)
                            ->schema([
                                TextInput::make('facebook_url')->url()
                                    ->label('Facebook URL')
                                    ->placeholder('https://www.facebook.com/username')
                                    ->prefixIcon('heroicon-o-globe-alt'),
                                TextInput::make('facebook_followers')
                                    ->placeholder('e.g. 15000')
                                    ->numeric()
                                    ->label('Facebook Followers'),

                                TextInput::make('instagram_url')
                                    ->placeholder('https://www.instagram.com/username')
                                    ->url()
                                    ->label('Instagram URL'),
                                TextInput::make('instagram_followers')
                                    ->placeholder('e.g. 20000')
                                    ->numeric()
                                    ->label('Instagram Followers'),

                                TextInput::make('tiktok_url')
                                    ->placeholder('https://www.tiktok.com/@username')
                                    ->url()
                                    ->label('TikTok URL'),
                                TextInput::make('tiktok_followers')
                                    ->placeholder('e.g. 25000')
                                    ->numeric()
                                    ->label('TikTok Followers'),

                                TextInput::make('youtube_url')
                                    ->placeholder('https://www.youtube.com/username')
                                    ->url()
                                    ->label('YouTube URL'),
                                TextInput::make('linkedin_url')
                                    ->placeholder('https://www.linkedin.com/in/username')
                                    ->url()
                                    ->label('LinkedIn URL'),

                                TextInput::make('portfolio_url')
                                    ->placeholder('https://yourportfolio.com')
                                    ->label('Portfolio Website')
                                    ->url()
                                    ->columnSpanFull()
                                    ->helperText('External portfolio, Behance, or personal website'),
                            ]),
                    ]),
                // === END OF PROFILE RELATIONSHIP ===

                // 6. Portfolio Gallery (Belongs to User model)
                Section::make('Artist Portfolio Gallery')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('portfolio')
                            ->label('Portfolio Images')
                            ->collection('portfolio')
                            ->multiple()
                            ->disk('public')
                            ->reorderable()
                            ->maxFiles(50)
                            ->image()
                            ->imageEditor()
                            ->panelLayout('grid')
                            ->columnSpanFull(),
                    ]),

                // 7. Verification Documents (Belongs to User model)
                Section::make('Verification Documents')
                    ->description('Private documents uploaded by the user for verification.')
                    ->columns(2)
                    ->schema([

                        // ── FRONT SIDE ─────────────────────────────────────────────
                        Grid::make(1)
                            ->schema([
                                Placeholder::make('nid_preview')
                                    ->label('NID/Passport/Birth Front Side — Current File')
                                    ->content(function ($record): \Illuminate\Support\HtmlString {
                                        if (!$record || !$record->nid_path) {
                                            return new \Illuminate\Support\HtmlString(
                                                '<span style="color:#9ca3af; font-size:0.85rem;">No document uploaded yet.</span>'
                                            );
                                        }
                                        $url = route('admin.document.view', ['type' => 'nid', 'user' => $record->id]);
                                        return new \Illuminate\Support\HtmlString("
                            <div style='display:flex; flex-direction:column; gap:10px;'>
                                <img src='{$url}' style='max-width:100%; max-height:220px; object-fit:contain; border:1px solid #e5e7eb; border-radius:6px; background:#f9fafb;'
                                     onerror=\"this.style.display='none'; document.getElementById('nid-link-{$record->id}').style.display='inline-flex';\">
                                <a id='nid-link-{$record->id}' href='{$url}' target='_blank'
                                   style='display:none; font-size:0.8rem; color:#6366f1; font-weight:600;'>Open Document ↗</a>
                                <a href='{$url}' target='_blank'
                                   style='font-size:0.78rem; color:#6b7280; text-decoration:underline;'>View / Download full file ↗</a>
                            </div>
                        ");
                                    }),

                                FileUpload::make('nid_path')
                                    ->label('Upload New Front Side Document')
                                    ->disk('private')              // your private disk name
                                    ->directory('verification/nid')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                                    ->maxSize(5120)                // 5 MB
                                    ->downloadable()
                                    ->openable()
                                    ->previewable(true)
                                    ->imagePreviewHeight('180')
                                    ->helperText('Accepted: JPG, PNG, WebP, PDF — Max 5 MB. Uploading a new file will replace the existing one.')
                                    ->saveUploadedFileUsing(function ($file, $record) {
                                        // Delete old file if exists
                                        if ($record?->nid_path) {
                                            \Illuminate\Support\Facades\Storage::disk('private')->delete($record->nid_path);
                                        }

                                        $filename = 'nid_' . ($record?->id ?? 'new') . '_' . time() . '.' . $file->getClientOriginalExtension();
                                        $path = $file->storeAs('verification/nid', $filename, 'private');

                                        $record->update(['nid_path' => $path]);

                                        return $path;
                                    }),
                            ]),

                        // ── BACK SIDE ──────────────────────────────────────────────
                        Grid::make(1)
                            ->schema([
                                Placeholder::make('nid_back_preview')
                                    ->label('NID/Passport/Birth Back Side — Current File')
                                    ->content(function ($record): \Illuminate\Support\HtmlString {
                                        if (!$record || !$record->nid_back_path) {
                                            return new \Illuminate\Support\HtmlString(
                                                '<span style="color:#9ca3af; font-size:0.85rem;">No document uploaded yet.</span>'
                                            );
                                        }
                                        $url = route('admin.document.view', ['type' => 'nid_back', 'user' => $record->id]);
                                        return new \Illuminate\Support\HtmlString("
                            <div style='display:flex; flex-direction:column; gap:10px;'>
                                <img src='{$url}' style='max-width:100%; max-height:220px; object-fit:contain; border:1px solid #e5e7eb; border-radius:6px; background:#f9fafb;'
                                     onerror=\"this.style.display='none'; document.getElementById('acad-link-{$record->id}').style.display='inline-flex';\">
                                <a id='acad-link-{$record->id}' href='{$url}' target='_blank'
                                   style='display:none; font-size:0.8rem; color:#6366f1; font-weight:600;'>Open Document ↗</a>
                                <a href='{$url}' target='_blank'
                                   style='font-size:0.78rem; color:#6b7280; text-decoration:underline;'>View / Download full file ↗</a>
                            </div>
                        ");
                                    }),

                                FileUpload::make('nid_back_path')
                                    ->label('Upload New Back Side Document')
                                    ->disk('private')
                                    ->directory('verification/nid_back')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'application/pdf'])
                                    ->maxSize(5120)
                                    ->downloadable()
                                    ->openable()
                                    ->previewable(true)
                                    ->imagePreviewHeight('180')
                                    ->helperText('Accepted: JPG, PNG, WebP, PDF — Max 5 MB. Uploading a new file will replace the existing one.')
                                    ->saveUploadedFileUsing(function ($file, $record) {
                                        if ($record?->nid_back_path) {
                                            \Illuminate\Support\Facades\Storage::disk('private')->delete($record->nid_back_path);
                                        }

                                        $filename = 'nid_back_' . $record->id . '_' . time() . '.' . $file->getClientOriginalExtension();
                                        $path = $file->storeAs('verification/nid_back', $filename, 'private');

                                        $record->update(['nid_back_path' => $path]);

                                        return $path;
                                    }),
                            ]),

                        // ── STATUS SELECTS (unchanged) ─────────────────────────────
                        Select::make('verification_status')
                            ->label('NID/Passport/Birth Front Side Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending' => 'Pending Review',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unverified')
                            ->required()
                            ->selectablePlaceholder(false)
                            ->native(false),

                        Select::make('nid_back_verification_status')
                            ->label('NID/Passport/Birth Back Side Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending' => 'Pending Review',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unverified')
                            ->required()
                            ->selectablePlaceholder(false)
                            ->native(false),
                    ]),
                // 8. Artist Experience & Credits
                // inside the repeater area
                Section::make('Experience & Credits')
                    ->description('Professional history including acting, modeling, awards, and other industry credits.')
                    ->schema([
                        Repeater::make('experiences')
                            ->relationship('experiences')
                            ->schema([
                                Select::make('type')
                                    ->label('Type')
                                    ->options(\App\Models\ArtistExperience::$typeLabels)
                                    ->required()
                                    ->live()
                                    ->columnSpan(1),

                                TextInput::make('custom_type_label')
                                    ->label('Custom Type Label')
                                    ->placeholder('e.g. Podcast, Voice Over')
                                    ->maxLength(100)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => $get('type') === 'custom'),

                                TextInput::make('year')
                                    ->label('Year')
                                    ->placeholder('e.g. 2021 or 2021–2023')
                                    ->maxLength(10)
                                    ->autocomplete('off')
                                    ->columnSpan(1),

                                TextInput::make('title')
                                    ->label('Title / Name')
                                    ->placeholder('e.g. Dhaka Fashion Week, Rehana Maryam Noor')
                                    ->required()
                                    ->maxLength(255)
                                    ->autocomplete('off')
                                    ->columnSpan(2),

                                TextInput::make('role')
                                    ->label('Role / Character / Position')
                                    ->placeholder('e.g. Lead Actor, Showstopper, Host')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'acting_screen',
                                        'modeling_fashion',
                                        'photography_media',
                                        'advertising_promotion',
                                        'event_hosting',
                                        'digital_content',
                                        'other',
                                    ])),

                                TextInput::make('director')
                                    ->label('Director / Photographer')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'acting_screen',
                                        'photography_media',
                                        'advertising_promotion',
                                        'digital_content',
                                    ])),

                                TextInput::make('production')
                                    ->label('Production House / Channel / Brand')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'acting_screen',
                                        'modeling_fashion',
                                        'photography_media',
                                        'advertising_promotion',
                                        'event_hosting',
                                        'digital_content',
                                    ])),

                                TextInput::make('notes')
                                    ->label('Notes')
                                    ->placeholder('e.g. Debut, Main Campaign')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'acting_screen',
                                        'modeling_fashion',
                                        'photography_media',
                                        'advertising_promotion',
                                        'event_hosting',
                                        'digital_content',
                                        'other',
                                    ])),

                                TextInput::make('award_category')
                                    ->label(fn(Get $get) => $get('type') === 'competitions_pageants' ? 'Competition Category' : 'Award Category')
                                    ->placeholder('e.g. Best Actress, Top Model')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), ['awards_achievements', 'competitions_pageants'])),

                                TextInput::make('award_work')
                                    ->label('For the Work / Project')
                                    ->placeholder('e.g. Rehana Maryam Noor')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), ['awards_achievements'])),

                                Select::make('award_result')
                                    ->label('Result / Placement')
                                    ->options([
                                        'Won' => 'Won',
                                        'Nominated' => 'Nominated',
                                        'Winner' => 'Winner',
                                        'Runner-up' => 'Runner-up',
                                        'Participant' => 'Participant',
                                    ])
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), ['awards_achievements', 'competitions_pageants'])),

                                TextInput::make('jury_location')
                                    ->label('Location')
                                    ->placeholder('e.g. Dhaka, Bangladesh')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), ['workshop_training', 'event_hosting', 'competitions_pageants'])),

                                Textarea::make('description')
                                    ->label('Description')
                                    ->rows(3)
                                    ->maxLength(1000)
                                    ->columnSpanFull(),

                                TextInput::make('language')
                                    ->label('Language')
                                    ->maxLength(100)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'acting_screen',
                                        'digital_content',
                                        'other',
                                    ])),

                                TextInput::make('platform')
                                    ->label('Platform / Medium')
                                    ->maxLength(100)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'acting_screen',
                                        'digital_content',
                                        'advertising_promotion',
                                    ])),

                                TextInput::make('award_organizer')
                                    ->label('Organizer / Institution / Agency')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(Get $get) => in_array($get('type'), [
                                        'awards_achievements',
                                        'competitions_pageants',
                                        'workshop_training',
                                        'event_hosting',
                                    ])),
                            ])
                            ->columns(4)
                            ->reorderable()
                            ->orderColumn('sort_order')
                            ->collapsible()
                            ->collapsed()
                            ->itemLabel(
                                fn(array $state): ?string =>
                                ($state['year'] ? '[' . $state['year'] . '] ' : '') .
                                ($state['title'] ?? 'New Entry') .
                                ($state['type'] ? ' — ' . (
                                    $state['type'] === 'custom'
                                    ? ($state['custom_type_label'] ?? 'Custom')
                                    : (\App\Models\ArtistExperience::$typeLabels[$state['type']] ?? '')
                                ) : '')
                            )
                            ->addActionLabel('Add Experience / Credit')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
