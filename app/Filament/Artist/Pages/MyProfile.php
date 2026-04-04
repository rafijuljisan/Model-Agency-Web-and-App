<?php

namespace App\Filament\Artist\Pages;

use App\Models\Profile;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TagsInput;

class MyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'My Profile & Portfolio';
    protected static ?string $title = 'Manage Your Public Profile';
    protected string $view = 'filament.artist.pages.my-profile';

    public ?array $data = [];

    public function mount(): void
    {
        // Load the artist's existing profile data
        $profile = Auth::user()->profile;

        if ($profile) {
            $this->form->fill($profile->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category')
                    ->options([
                        'Model' => 'Model',
                        'Photographer' => 'Photographer',
                        'Video Editor' => 'Video Editor',
                        'Cinematographer' => 'Cinematographer',
                        'Actor' => 'Actor',
                    ])
                    ->required(),

                TextInput::make('location')
                    ->label('City / Location')
                    ->required(),

                TextInput::make('hourly_rate')
                    ->label('Starting Rate (BDT)')
                    ->numeric()
                    ->prefix('৳'),

                Textarea::make('bio')
                    ->label('About Me')
                    ->rows(4)
                    ->placeholder('Tell clients about your experience...'),

                TextInput::make('height')
                    ->label('Height (Optional)')
                    ->placeholder('e.g. 5.9 ft'),

                TextInput::make('weight')
                    ->label('Weight (Optional)')
                    ->placeholder('e.g. 70 kg'),

                Select::make('gender')
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                        'Other' => 'Other',
                    ]),

                DatePicker::make('date_of_birth')
                    ->label('Date of Birth')
                    ->maxDate(now()->subYears(13)) // Minimum age 13
                    ->required(),

                TextInput::make('height_cm')
                    ->label('Height (in CM)')
                    ->numeric()
                    ->placeholder('e.g., 165'),

                TagsInput::make('languages')
                    ->label('Languages Spoken')
                    ->placeholder('Type a language and press Enter (e.g. Bengali, English)')
                    ->suggestions(['Bengali', 'English', 'Hindi', 'Urdu', 'Russian']), // A nod to your Russian learning!

                // Hierarchical Location
                Select::make('country')
                    ->options(['Bangladesh' => 'Bangladesh'])
                    ->default('Bangladesh')
                    ->required(),

                TextInput::make('district')
                    ->label('District')
                    ->placeholder('Start typing to search or add new...')
                    ->datalist(
                        // This dynamically fetches every unique district already saved in the database
                        Profile::query()
                            ->whereNotNull('district')
                            ->distinct()
                            ->orderBy('district')
                            ->pluck('district')
                            ->toArray()
                    )
                    ->required(),

                TextInput::make('upazila')
                    ->label('Thana / Upazila')
                    ->placeholder('Start typing to search or add new...')
                    ->datalist(
                        // This dynamically fetches every unique upazila already saved in the database
                        Profile::query()
                            ->whereNotNull('upazila')
                            ->distinct()
                            ->orderBy('upazila')
                            ->pluck('upazila')
                            ->toArray()
                    ),
                SpatieMediaLibraryFileUpload::make('portfolio')
                    ->label('Portfolio Gallery (Upload your best work)')
                    ->collection('portfolio') // Saves to the public portfolio collection
                    ->multiple()
                    ->disk('public') // Ensure these are publicly accessible for the directory
                    ->reorderable()
                    ->maxFiles(10)
                    ->image()
                    ->imageEditor(), // Lets artists crop their photos inside the dashboard!
            ])
            ->statePath('data')
            ->model(Auth::user()); // Links the media uploads to the User model
    }

    public function submit(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        // Update or Create the Profile row
        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'category' => $data['category'] ?? null,
                'location' => $data['location'] ?? null,
                'hourly_rate' => $data['hourly_rate'] ?? null,
                'bio' => $data['bio'] ?? null,
                'height' => $data['height'] ?? null,
                'weight' => $data['weight'] ?? null,
            ]
        );

        Notification::make()
            ->title('Profile Updated')
            ->success()
            ->send();
    }
}