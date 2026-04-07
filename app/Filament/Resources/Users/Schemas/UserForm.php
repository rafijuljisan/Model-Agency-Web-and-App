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
use Filament\Forms\Components\FileUpload;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // 1. Core User Account Details
                Section::make('Account Details')
                    ->columns(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->collection('avatar')
                            ->disk('public')
                            ->image()
                            ->imageEditor()
                            ->imageAspectRatio('1:1')                    // ← replaces imageCropAspectRatio
                            ->automaticallyCropImagesToAspectRatio()      // ← new required companion
                            ->automaticallyResizeImagesToWidth(400)       // ← replaces imageResizeTargetWidth
                            ->automaticallyResizeImagesToHeight(400)      // ← replaces imageResizeTargetHeight
                            ->columnSpanFull()
                            ->helperText('Square image recommended. Max 3MB.'),

                        TextInput::make('member_id')
                            ->label('Member ID')
                            ->disabled() // Prevent manual editing to maintain sequential integrity
                            ->dehydrated(false) // Prevents saving the disabled field
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
                    ]),

                // 2. Public Profile Information
                Section::make('Public Profile Information')
                    ->schema([
                        Group::make()
                            ->relationship('profile')
                            ->columns(2)
                            ->schema([
                                Select::make('categories')
                                    ->label('Talent Categories & Skills')
                                    ->options(function (?\Illuminate\Database\Eloquent\Model $record) {
                                        // 1. Get ALL categories (active and inactive)
                                        $options = \App\Models\Category::orderBy('group')
                                            ->orderBy('name')
                                            ->pluck('name', 'name')
                                            ->toArray();

                                        // 2. Determine the saved categories. 
                                        // Inside relationship('profile'), $record IS the Profile model.
                                        $savedCategories = [];

                                        if ($record) {
                                            // Check if we are interacting with the Profile model directly
                                            if (isset($record->categories) && is_array($record->categories)) {
                                                $savedCategories = $record->categories;
                                            }
                                            // Fallback just in case Filament passes the User model
                                            elseif (isset($record->profile->categories) && is_array($record->profile->categories)) {
                                                $savedCategories = $record->profile->categories;
                                            }
                                        }

                                        // 3. Inject any missing legacy categories into the options list
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

                                TextInput::make('height_cm')
                                    ->label('Height (cm)')
                                    ->numeric(),

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
                                TextInput::make('facebook_url')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->placeholder('https://facebook.com/...')
                                    ->prefixIcon('heroicon-o-globe-alt'),

                                TextInput::make('instagram_url')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->placeholder('https://instagram.com/...'),

                                TextInput::make('youtube_url')
                                    ->label('YouTube URL')
                                    ->url()
                                    ->placeholder('https://youtube.com/...'),

                                TextInput::make('tiktok_url')
                                    ->label('TikTok URL')
                                    ->url()
                                    ->placeholder('https://tiktok.com/...'),

                                TextInput::make('linkedin_url')
                                    ->label('LinkedIn URL')
                                    ->url()
                                    ->placeholder('https://linkedin.com/in/...'),

                                TextInput::make('portfolio_url')
                                    ->label('Portfolio Website')
                                    ->url()
                                    ->placeholder('https://yourportfolio.com')
                                    ->columnSpanFull()
                                    ->helperText('External portfolio, Behance, or personal website'),
                            ]),
                    ]),

                // 3. Portfolio Gallery — 2 column grid
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
                            ->panelLayout('grid')        // ← Makes it a grid
                            ->columnSpanFull(),
                    ]),

                // 4. Verification Documents
                Section::make('Verification Documents')
                    ->description('Private documents uploaded by the user for verification.')
                    ->columns(2)
                    ->schema([

                        // ── NID VIEWER ──
                        // We use a Placeholder to render a custom view of the stored file.
                        // FileUpload won't work here because nid_path is a plain string path,
                        // not a Spatie media record, and it's on the 'private' disk.
                        \Filament\Forms\Components\Placeholder::make('nid_preview')
                            ->label('National ID (NID)')
                            ->content(function ($record): \Illuminate\Support\HtmlString {
                                if (!$record || !$record->nid_path) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<span style="color:#9ca3af; font-size:0.85rem;">No document uploaded yet.</span>'
                                    );
                                }

                                // Build a URL using a signed route so the private file is
                                // served securely without exposing the real disk path.
                                $url = route('admin.document.view', [
                                    'type' => 'nid',
                                    'user' => $record->id,
                                ]);

                                return new \Illuminate\Support\HtmlString("
                    <div style='display:flex; flex-direction:column; gap:10px;'>
                        <img src='{$url}'
                             style='max-width:100%; max-height:280px; object-fit:contain;
                                    border:1px solid #e5e7eb; border-radius:6px; background:#f9fafb;'
                             onerror=\"this.style.display='none'; document.getElementById('nid-link-{$record->id}').style.display='inline-flex';\">
                        <a id='nid-link-{$record->id}'
                           href='{$url}' target='_blank'
                           style='display:none; font-size:0.8rem; color:#6366f1; font-weight:600;'>
                            Open Document ↗
                        </a>
                        <a href='{$url}' target='_blank'
                           style='font-size:0.78rem; color:#6b7280; text-decoration:underline;'>
                            View / Download full file ↗
                        </a>
                    </div>
                ");
                            }),

                        // ── ACADEMIC CERTIFICATE VIEWER ──
                        \Filament\Forms\Components\Placeholder::make('academic_preview')
                            ->label('Academic Certificate')
                            ->content(function ($record): \Illuminate\Support\HtmlString {
                                if (!$record || !$record->academic_certificate_path) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<span style="color:#9ca3af; font-size:0.85rem;">No document uploaded yet.</span>'
                                    );
                                }

                                $url = route('admin.document.view', [
                                    'type' => 'academic',
                                    'user' => $record->id,
                                ]);

                                return new \Illuminate\Support\HtmlString("
                    <div style='display:flex; flex-direction:column; gap:10px;'>
                        <img src='{$url}'
                             style='max-width:100%; max-height:280px; object-fit:contain;
                                    border:1px solid #e5e7eb; border-radius:6px; background:#f9fafb;'
                             onerror=\"this.style.display='none'; document.getElementById('acad-link-{$record->id}').style.display='inline-flex';\">
                        <a id='acad-link-{$record->id}'
                           href='{$url}' target='_blank'
                           style='display:none; font-size:0.8rem; color:#6366f1; font-weight:600;'>
                            Open Document ↗
                        </a>
                        <a href='{$url}' target='_blank'
                           style='font-size:0.78rem; color:#6b7280; text-decoration:underline;'>
                            View / Download full file ↗
                        </a>
                    </div>
                ");
                            }),

                        // ── NID STATUS ──
                        Select::make('verification_status')
                            ->label('NID Verification Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending' => 'Pending Review',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unverified')
                            ->native(false),

                        // ── ACADEMIC STATUS ──
                        Select::make('academic_verification_status')
                            ->label('Academic Verification Status')
                            ->options([
                                'unverified' => 'Unverified',
                                'pending' => 'Pending Review',
                                'verified' => 'Verified',
                                'rejected' => 'Rejected',
                            ])
                            ->default('unverified')
                            ->native(false),
                    ]),

            ]);
    }
}