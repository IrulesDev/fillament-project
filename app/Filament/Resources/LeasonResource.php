<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeasonResource\Pages;
use App\Filament\Resources\LeasonResource\RelationManagers;
use App\Models\Leason;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeasonResource extends Resource
{
    protected static ?string $model = Leason::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('kelas_santri.name')

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListLeasons::route('/'),
            'create' => Pages\CreateLeason::route('/create'),
            'view' => Pages\ViewLeason::route('/{record}'),
            'edit' => Pages\EditLeason::route('/{record}/edit'),
        ];
    }
}
