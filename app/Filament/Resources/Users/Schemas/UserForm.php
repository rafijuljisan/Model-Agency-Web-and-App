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
                            ->unique(ignoreRecord: true),

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
                            ->helperText('Override the algorithm and force this talent to the top of the homepage.')
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
                                        $options = \App\Models\Category::orderBy('group')
                                            ->orderBy('name')
                                            ->pluck('name', 'name')
                                            ->toArray();

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
                                    ->label('Languages Spoken'),

                                TextInput::make('country')
                                    ->default('Bangladesh'),

                                TextInput::make('district')
                                    ->label('District'),

                                TextInput::make('upazila')
                                    ->label('Thana / Upazila'),

                                Textarea::make('bio')
                                    ->label('About Me (Bio)')
                                    ->columnSpanFull()
                                    ->rows(4),
                            ]),

                        // 3. Measurements & Appearance
                        Section::make('Measurements & Appearance')
                            ->columns(4)
                            ->schema([
                                TextInput::make('height_cm')
                                    ->label('Height (cm)')
                                    ->numeric(),

                                TextInput::make('weight_kg')
                                    ->label('Weight (kg)')
                                    ->numeric(),

                                TextInput::make('chest_bust_inches')
                                    ->label('Chest / Bust (in)')
                                    ->numeric(),

                                TextInput::make('waist_inches')
                                    ->label('Waist (in)')
                                    ->numeric(),

                                TextInput::make('hips_inches')
                                    ->label('Hips (in)')
                                    ->numeric(),

                                TextInput::make('shoulder_inches')
                                    ->label('Shoulder (in) — Male')
                                    ->numeric(),

                                TextInput::make('shoe_size')
                                    ->label('Shoe Size')
                                    ->placeholder('e.g. EU 42 / UK 8'),

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
                                    ->placeholder('e.g. Brown'),

                                TextInput::make('hair_color')
                                    ->label('Hair Color')
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
                                TextInput::make('facebook_url')->url()->label('Facebook URL')->prefixIcon('heroicon-o-globe-alt'),
                                TextInput::make('facebook_followers')->numeric()->label('Facebook Followers'),

                                TextInput::make('instagram_url')->url()->label('Instagram URL'),
                                TextInput::make('instagram_followers')->numeric()->label('Instagram Followers'),

                                TextInput::make('tiktok_url')->url()->label('TikTok URL'),
                                TextInput::make('tiktok_followers')->numeric()->label('TikTok Followers'),

                                TextInput::make('youtube_url')->url()->label('YouTube URL'),
                                TextInput::make('linkedin_url')->url()->label('LinkedIn URL'),

                                TextInput::make('portfolio_url')
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
                            ->maxFiles(10)
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
            ]);
    }
}