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
use Filament\Schemas\Get;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Utilities\Get as SchemaGet;

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
                                        // 1. Fetch categories and format them as "CategoryName (GroupName)"
                                        $options = \App\Models\Category::orderBy('group')
                                            ->orderBy('name')
                                            ->get()
                                            ->mapWithKeys(function ($category) {
                                            // The array key is what saves to the database ($category->name)
                                            // The array value is what the user sees in the dropdown
                                            return [$category->name => "{$category->name} — ({$category->group})"];
                                        })
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
                                    ->options([
                                        'Fair' => 'Fair',
                                        'Medium' => 'Medium',
                                        'Dusky' => 'Dusky',
                                        'Deep' => 'Deep',
                                    ]),

                                TextInput::make('eye_color')
                                    ->label('Eye Color')
                                    ->autocomplete('off')
                                    ->placeholder('e.g. Brown'),

                                TextInput::make('hair_color')
                                    ->label('Hair Color')
                                    ->autocomplete('off')
                                    ->placeholder('e.g. Black'),

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
                            ->maxFiles(12)
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
                        \Filament\Forms\Components\Placeholder::make('nid_preview')
                            ->label('National ID (NID)')
                            ->content(function ($record): \Illuminate\Support\HtmlString {
                                if (!$record || !$record->nid_path) {
                                    return new \Illuminate\Support\HtmlString('<span style="color:#9ca3af; font-size:0.85rem;">No document uploaded yet.</span>');
                                }
                                $url = route('admin.document.view', ['type' => 'nid', 'user' => $record->id]);
                                return new \Illuminate\Support\HtmlString("
                                    <div style='display:flex; flex-direction:column; gap:10px;'>
                                        <img src='{$url}' style='max-width:100%; max-height:280px; object-fit:contain; border:1px solid #e5e7eb; border-radius:6px; background:#f9fafb;' onerror=\"this.style.display='none'; document.getElementById('nid-link-{$record->id}').style.display='inline-flex';\">
                                        <a id='nid-link-{$record->id}' href='{$url}' target='_blank' style='display:none; font-size:0.8rem; color:#6366f1; font-weight:600;'>Open Document ↗</a>
                                        <a href='{$url}' target='_blank' style='font-size:0.78rem; color:#6b7280; text-decoration:underline;'>View / Download full file ↗</a>
                                    </div>
                                ");
                            }),

                        \Filament\Forms\Components\Placeholder::make('academic_preview')
                            ->label('Academic Certificate')
                            ->content(function ($record): \Illuminate\Support\HtmlString {
                                if (!$record || !$record->academic_certificate_path) {
                                    return new \Illuminate\Support\HtmlString('<span style="color:#9ca3af; font-size:0.85rem;">No document uploaded yet.</span>');
                                }
                                $url = route('admin.document.view', ['type' => 'academic', 'user' => $record->id]);
                                return new \Illuminate\Support\HtmlString("
                                    <div style='display:flex; flex-direction:column; gap:10px;'>
                                        <img src='{$url}' style='max-width:100%; max-height:280px; object-fit:contain; border:1px solid #e5e7eb; border-radius:6px; background:#f9fafb;' onerror=\"this.style.display='none'; document.getElementById('acad-link-{$record->id}').style.display='inline-flex';\">
                                        <a id='acad-link-{$record->id}' href='{$url}' target='_blank' style='display:none; font-size:0.8rem; color:#6366f1; font-weight:600;'>Open Document ↗</a>
                                        <a href='{$url}' target='_blank' style='font-size:0.78rem; color:#6b7280; text-decoration:underline;'>View / Download full file ↗</a>
                                    </div>
                                ");
                            }),

                        Select::make('verification_status')
                            ->label('NID Verification Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending' => 'Pending Review',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unverified')
                            ->required()                   // ← ADD THIS
                            ->selectablePlaceholder(false) // ← ADD THIS
                            ->native(false),

                        Select::make('academic_verification_status')
                            ->label('Academic Verification Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending' => 'Pending Review',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unverified')
                            ->required()                   // ← ADD THIS
                            ->selectablePlaceholder(false) // ← ADD THIS
                            ->native(false),
                    ]),
                // 8. Artist Experience & Credits
                Section::make('Experience & Credits')
                    ->description('Films, TV shows, awards, jury activity, and other professional credits.')
                    ->schema([
                        \Filament\Forms\Components\Repeater::make('experiences')
                            ->relationship('experiences')
                            ->schema([
                                \Filament\Forms\Components\Select::make('type')
                                    ->label('Type')
                                    ->options(\App\Models\ArtistExperience::$typeLabels)
                                    ->required()
                                    ->live()
                                    ->columnSpan(1),

                                TextInput::make('year')
                                    ->label('Year')
                                    ->placeholder('e.g. 2021 or 2021–2023')
                                    ->maxLength(10)
                                    ->autocomplete('off')
                                    ->columnSpan(1),

                                TextInput::make('title')
                                    ->label('Title / Name')
                                    ->placeholder('e.g. Rehana Maryam Noor')
                                    ->required()
                                    ->maxLength(255)
                                    ->autocomplete('off')
                                    ->columnSpan(2),

                                // ── Film / TV / Commercial fields ──
                                TextInput::make('role')
                                    ->label('Role / Character')
                                    ->placeholder('e.g. Rehana Maryam Noor')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), [
                                        'film',
                                        'tv_drama',
                                        'commercial',
                                        'theater',
                                        'music_video',
                                        'other'
                                    ])),

                                TextInput::make('director')
                                    ->label('Director')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), [
                                        'film',
                                        'tv_drama',
                                        'commercial',
                                        'theater',
                                        'music_video'
                                    ])),

                                TextInput::make('production')
                                    ->label('Production House / Channel')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), [
                                        'film',
                                        'tv_drama',
                                        'commercial',
                                        'theater',
                                        'music_video'
                                    ])),

                                TextInput::make('notes')
                                    ->label('Notes')
                                    ->placeholder('e.g. Debut Film')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), [
                                        'film',
                                        'tv_drama',
                                        'commercial',
                                        'theater',
                                        'music_video',
                                        'other'
                                    ])),

                                // ── Award fields ──
                                TextInput::make('award_category')
                                    ->label('Award Category')
                                    ->placeholder('e.g. Best Actress')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), ['award'])),

                                TextInput::make('award_work')
                                    ->label('For the Work')
                                    ->placeholder('e.g. Rehana Maryam Noor')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), ['award'])),

                                \Filament\Forms\Components\Select::make('award_result')
                                    ->label('Result')
                                    ->options(['Won' => 'Won', 'Nominated' => 'Nominated'])
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), ['award'])),

                                // ── Jury fields ──
                                TextInput::make('jury_festival')
                                    ->label('Festival Name')
                                    ->placeholder('e.g. I Am Tomorrow Film Festival')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), ['jury'])),

                                TextInput::make('jury_location')
                                    ->label('Location')
                                    ->placeholder('e.g. Brussels')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), ['jury'])),

                                TextInput::make('jury_category')
                                    ->label('Jury Category')
                                    ->placeholder('e.g. Asian films Competition')
                                    ->maxLength(255)
                                    ->columnSpan(1)
                                    ->visible(fn(SchemaGet $get) => in_array($get('type'), ['jury'])),
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
                                ($state['type'] ? ' — ' . (\App\Models\ArtistExperience::$typeLabels[$state['type']] ?? '') : '')
                            )
                            ->addActionLabel('Add Experience / Credit')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}