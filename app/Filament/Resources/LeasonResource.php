<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeasonResource\Pages;
use App\Filament\Resources\LeasonResource\RelationManagers;
use App\Models\KelasSantri;
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
                TextColumn::make('name')
                ->searchable()
                ->label('Nama Pelajaran'),
                TextColumn::make('kelas_santri.major')
                ->searchable()
                ->badge()
                ->color(function ($record) {
                    return match ($record->kelas_santri->major) {
                        'programmer' => 'blue',
                        'multimedia' => 'yellow',
                        'marketer' => 'red',
                        default => 'gray',
                    };
                }),
                TextColumn::make('kelas_santri.mentor.name')
                ->searchable()
                ->icon('heroicon-o-user-group')
                ->iconColor('primary'),
                TextColumn::make('description')
                ->limit(50)
                ->label('Deskripsi'),
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
