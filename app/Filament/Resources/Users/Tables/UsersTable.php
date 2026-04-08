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
            ->defaultSort('created_at', 'desc')
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
                    ->color(fn(string $state): string => match ($state) {
                        'verified' => 'success',
                        'pending' => 'warning',
                        'unverified' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('academic_verification_status')
                    ->label('Academic Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
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
                    ->visible(
                        fn($record) =>
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
                    ->visible(
                        fn($record) =>
                        $record->verification_status === 'pending' && $record->nid_path
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['verification_status' => 'rejected']); // ← was 'unverified'
            
                        $record->notify(new UserStatusNotification(
                            'National ID Rejected',
                            'Unfortunately, we could not verify the National ID you uploaded. Please log in and upload a clearer, original document.',
                            false
                        ));

                        Notification::make()->title('NID Rejected')->danger()->send();
                    }),

                // =========================
                // 🎓 ACADEMIC APPROVAL
                // =========================
                Action::make('approve_academic')
                    ->label('Approve Certificate')
                    ->color('success')
                    ->visible(
                        fn($record) =>
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
                    ->visible(
                        fn($record) =>
                        $record->academic_verification_status === 'pending' && $record->academic_certificate_path
                    )
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->update(['academic_verification_status' => 'rejected']); // ← was 'unverified'
            
                        $record->notify(new \App\Notifications\UserStatusNotification(
                            'Academic Certificate Rejected',
                            'Unfortunately, we could not verify the academic certificate you uploaded. Please log in and upload a clearer, valid document.',
                            false
                        ));

                        Notification::make()->title('Academic Certificate Rejected')->danger()->send();
                    }),
                // =========================
                // 🌟 ONE-CLICK FULL APPROVAL
                // =========================
                Action::make('approve_full_account')
                    ->label('Verify Account')
                    ->color('success')
                    ->icon('heroicon-o-check-badge')
                    ->visible(
                        fn($record) =>
                        $record->verification_status === 'pending' ||
                        $record->academic_verification_status === 'pending'
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Approve Artist Account')
                    ->modalDescription('Are you sure you want to approve both the NID and Academic Certificate for this user?')
                    ->action(function ($record) {
                        // Approve both documents at once
                        $record->update([
                            'verification_status' => 'verified',
                            'academic_verification_status' => 'verified',
                        ]);

                        // Assign the Verified Artist role
                        if (!$record->hasRole('Verified-Artist')) {
                            $record->assignRole('Verified-Artist');
                        }

                        // Trigger a single success email
                        $record->notify(new UserStatusNotification(
                            'Account Verified!',
                            'Great news! Your identity and academic documents have been verified. Your profile is now unlocked.',
                            true
                        ));

                        Notification::make()->title('Account Fully Verified')->success()->send();
                    }),
                Action::make('unverify_account')
                    ->label('Revoke Verification')
                    ->color('warning')
                    ->icon('heroicon-o-x-circle')
                    ->visible(
                        fn($record) =>
                        $record->verification_status === 'verified' ||
                        $record->academic_verification_status === 'verified'
                    )
                    ->requiresConfirmation()
                    ->modalHeading('Revoke Verification')
                    ->modalDescription('Are you sure you want to unverify this user? This will remove their Verified role and require them to upload documents again.')
                    ->action(function ($record) {

                        // 1. Reset the database columns to the 'unverified' string
                        $record->update([
                            'verification_status' => 'unverified',
                            'academic_verification_status' => 'unverified',
                        ]);

                        // 2. Safely remove the Verified-Artist role
                        if ($record->hasRole('Verified-Artist')) {
                            $record->removeRole('Verified-Artist');
                        }

                        Notification::make()
                            ->title('User Unverified')
                            ->warning()
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