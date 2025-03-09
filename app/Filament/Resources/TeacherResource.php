<?php

namespace App\Filament\Resources;

use DateTime;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Teacher;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Departement;
use App\Models\KelasSantri;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TeacherResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\TeacherResource\RelationManagers;

class TeacherResource extends Resource
{
    protected static ?string $model = User::class ;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'table';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role' , 'mentor');
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('name')
                ->searchable() //agar bisa di sarch
                ->icon('heroicon-m-user') //tambah icon mengguanakan heroicon
                ->iconColor('primary') //warna dari icon tersebut
                ->description(fn(User $record): string => "" . $record->email)
                ->sortable(query: function (Builder $query, string $direction): Builder {
                    return $query->orderBy('email', $direction);
                }),
            TextColumn::make('role')
                ->searchable()
                ->badge()
                ->color(function ($record) {
                    $role = $record->role;
                    if ($role == 'admin') {
                        return 'success';
                    }
                    if ($role == 'santri') {
                        return 'rose';
                    }
                    if ($role == 'mentor') {
                        return 'sky';
                    }
                    if ($role == 'leader') {
                        return 'fuchsia';
                    }
                }),

            

            TextColumn::make('kelas.major')
                ->iconColor('primary')
                ->icon('heroicon-o-academic-cap')
                ->searchable(
                    query: function (Builder $query, string $search): Builder {
                        $id = KelasSantri::where('major', 'like', '%' . $search . '%')->first()->id ?? null;
                        if ($id) {
                            return $query->where('kelas_id', 'like', '%' . $id . '%');
                        }
                        return $query;
                    }
                ),


            TextColumn::make('entry_date')
                ->sortable()
                ->tooltip(function ($record) {
                    return $record->entry_date . ' -> ' . $record->graduate_date;
                })
                ->getStateUsing(function ($record) {
                    $tanggalMasuk = new DateTime($record->entry_date);
                    $tanggalKeluar = new DateTime($record->graduate_date);

                    $totalBulan =
                        $tanggalMasuk->diff($tanggalKeluar)->m +
                        ($tanggalKeluar->format('Y') - $tanggalMasuk->format('Y')) * 12;

                    $tahun = floor($totalBulan / 12);
                    $sisaBulan = $totalBulan % 12;

                    if ($tahun > 0) {
                        if ($sisaBulan > 0) {
                            return $tahun . ' Tahun ' . $sisaBulan . ' Bulan';
                        }
                        return $tahun . ' Tahun';
                    }

                    return $totalBulan . ' Bulan';
                })

                ->label('Masa Santri')
                ->icon('heroicon-o-calendar-date-range')
                ->iconColor('primary')
                ->description(fn(User $record): string => "Angkatan " . $record->generation)
                ->sortable(query: function (Builder $query, string $direction): Builder {
                    return $query->orderBy('generation', $direction);
                }),
            TextColumn::make('created_at')
                ->date('Y-m-d')
                ->sortable()
                ->label('Created At')
                ->toggleable(isToggledHiddenByDefault: true),

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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'view' => Pages\ViewTeacher::route('/{record}'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
    public static function getLabel(): ?string
    {
        return 'Mentor' ;
    }
}
