<?php

namespace App\Filament\Artist\Pages;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class UploadVerification extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationLabel = 'NID / Verification';
    protected static ?string $title = 'Upload Verification Document';
    protected string $view = 'filament.artist.pages.upload-verification';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('verification_documents')
                    ->label('Upload NID, Passport, or Birth Certificate')
                    ->collection('verification_documents') // Keeps it separate from the public portfolio!
                    ->helperText('Your document is encrypted and only visible to the Super-Admin.')
                    ->maxFiles(1)
                    ->required(),
            ])
            ->statePath('data')
            ->model(Auth::user());
    }

    public function submit(): void
    {
        $this->form->getState();

        Notification::make()
            ->title('Document Uploaded Successfully')
            ->body('Our team will review your document shortly.')
            ->success()
            ->send();
    }
}