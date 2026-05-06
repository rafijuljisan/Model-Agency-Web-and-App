<?php

namespace App\Filament\Resources\GroomingBatches\Pages;

use App\Filament\Resources\GroomingBatches\GroomingBatchResource;
use Filament\Actions\DeleteAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class EditGroomingBatch extends EditRecord
{
    protected static string $resource = GroomingBatchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    // Fires before save — log exactly what's being written
    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::info('GroomingBatch saving data:', [
            'id'          => $this->record->id,
            'description' => $data['description'] ?? '(empty)',
        ]);

        return $data;
    }

    // Override save to catch silent failures
    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        try {
            $updated = parent::handleRecordUpdate($record, $data);

            // Verify description actually changed
            $record->refresh();
            if (isset($data['description']) && $record->description !== $data['description']) {
                Log::error('GroomingBatch description mismatch after save', [
                    'expected' => substr($data['description'], 0, 100),
                    'actual'   => substr($record->description, 0, 100),
                ]);

                Notification::make()
                    ->title('Warning: Description may not have saved')
                    ->body('The description field did not persist. Check if it is in $fillable.')
                    ->warning()
                    ->persistent()
                    ->send();
            }

            return $updated;

        } catch (\Throwable $e) {
            Log::error('GroomingBatch update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            Notification::make()
                ->title('Save failed')
                ->body($e->getMessage())
                ->danger()
                ->persistent()
                ->send();

            throw $e;
        }
    }
}
