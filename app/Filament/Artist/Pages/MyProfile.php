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

                SpatieMediaLibraryFileUpload::make('portfolio')
                    ->label('Portfolio Gallery (Upload your best work)')
                    ->collection('portfolio') // Saves to the public portfolio collection
                    ->multiple()
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