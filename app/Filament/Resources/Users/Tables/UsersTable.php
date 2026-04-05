<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Notifications\UserStatusNotification;

use Filament\Notifications\Notification;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('phone')->searchable(),

                TextColumn::make('roles.name')
                    ->badge()
                    ->searchable(),

                TextColumn::make('verification_status')
                    ->label('NID Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'unverified' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('academic_verification_status')
                    ->label('Academic Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'unverified' => 'danger',
                        default => 'gray',
                    }),
            ])

            ->actions([
                EditAction::make(),
                DeleteAction::make(),

                // =========================
                // ✅ NID APPROVAL
                // =========================
                Action::make('approve_nid')
                    ->label('Approve NID')
                    ->color('success')
                    ->visible(fn ($record) =>
                        $record->verification_status === 'pending'
                        && $record->nid_path
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['verification_status' => 'verified']);
                        if (!$record->hasRole('Verified-Artist')) {
                            $record->assignRole('Verified-Artist');
                        }

                        // ── TRIGGER USER EMAIL ──
                        $record->notify(new UserStatusNotification(
                            'National ID Approved!',
                            'Great news! Your National ID has been verified and approved by our team.',
                            true // isSuccess = true
                        ));

                        Notification::make()->title('NID Approved')->success()->send();
                    }),

                Action::make('reject_nid')
                    ->label('Reject NID')
                    ->color('danger')
                    ->visible(fn ($record) =>
                        $record->verification_status === 'pending'
                        && $record->nid_path
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['verification_status' => 'unverified']);

                        // ── TRIGGER USER EMAIL ──
                        $record->notify(new UserStatusNotification(
                            'National ID Rejected',
                            'Unfortunately, we could not verify the National ID you uploaded. Please log in and upload a clearer, original document.',
                            false // isSuccess = false (Red email button)
                        ));

                        Notification::make()->title('NID Rejected')->danger()->send();
                    }),

                // =========================
                // 🎓 ACADEMIC APPROVAL
                // =========================
                Action::make('approve_academic')
                    ->label('Approve Certificate')
                    ->color('success')
                    ->visible(fn ($record) =>
                        $record->academic_verification_status === 'pending'
                        && $record->academic_certificate_path
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'academic_verification_status' => 'verified',
                        ]);

                        // ── TRIGGER USER EMAIL (SUCCESS) ──
                        $record->notify(new \App\Notifications\UserStatusNotification(
                            'Academic Certificate Approved!',
                            'Great news! Your academic or training certificate has been successfully verified by our team.',
                            true // Shows the green success button
                        ));

                        Notification::make()
                            ->title('Academic Certificate Approved')
                            ->success()
                            ->send();
                    }),

                Action::make('reject_academic')
                    ->label('Reject Certificate')
                    ->color('danger')
                    ->visible(fn ($record) =>
                        $record->academic_verification_status === 'pending'
                        && $record->academic_certificate_path
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update([
                            'academic_verification_status' => 'unverified',
                        ]);

                        // ── TRIGGER USER EMAIL (REJECTED) ──
                        $record->notify(new \App\Notifications\UserStatusNotification(
                            'Academic Certificate Rejected',
                            'Unfortunately, we could not verify the academic certificate you uploaded. Please log in to your dashboard and upload a clearer, valid document.',
                            false // Shows the red error button
                        ));

                        Notification::make()
                            ->title('Academic Certificate Rejected')
                            ->danger()
                            ->send();
                    }),
            ])

            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}