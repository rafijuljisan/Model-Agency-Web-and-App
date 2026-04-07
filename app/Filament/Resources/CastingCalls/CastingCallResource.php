<?php

namespace App\Filament\Resources\CastingCalls;

use App\Filament\Resources\CastingCalls\Pages\CreateCastingCall;
use App\Filament\Resources\CastingCalls\Pages\EditCastingCall;
use App\Filament\Resources\CastingCalls\Pages\ListCastingCalls;
use App\Filament\Resources\CastingCalls\Schemas\CastingCallForm;
use App\Filament\Resources\CastingCalls\Tables\CastingCallsTable;
use App\Models\CastingCall;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CastingCallResource extends Resource
{
    protected static ?string $model = CastingCall::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserPlus;

    protected static ?string $recordTitleAttribute = 'Casting';

    public static function form(Schema $schema): Schema
    {
        return CastingCallForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CastingCallsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCastingCalls::route('/'),
            'create' => CreateCastingCall::route('/create'),
            'edit' => EditCastingCall::route('/{record}/edit'),
        ];
    }
}
