<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\RapotSantri;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RapotSantriResource\Pages;
use App\Filament\Resources\RapotSantriResource\RelationManagers;

class RapotSantriResource extends Resource
{
    protected static ?string $model = RapotSantri::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'table';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Wizard::make([
                Step::make('Data Rapot Santri')
                    ->icon('heroicon-o-document-text')
                    ->completedIcon('heroicon-m-document-text')
                    ->columns(4)
                    ->schema([
                        Section::make('Informasi Rapot Santri')
                            ->description('Masukkan data rapot untuk santri')
                            ->schema([
                                Grid::make([
                                    'md' => 1,
                                    'lg' => 2,
                                    'xl' => 4,
                                ])->schema([
                                    Select::make('santri_id')
                                        ->label('Santri')
                                        ->relationship('santri', 'name')
                                        ->placeholder('Pilih Santri')
                                        ->preload() 
                                        ->required()
                                        ->searchable(),
                                    TextInput::make('academy_year')
                                        ->label('Tahun Akademik')
                                        ->placeholder('Contoh: 2023/2024')
                                        ->required(),
                                    TextInput::make('overall_score')
                                        ->label('Skor Keseluruhan')
                                        ->numeric()
                                        ->placeholder('Masukkan nilai keseluruhan')
                                        ->required(),
                                    Textarea::make('strengths')
                                        ->label('Kekuatan')
                                        ->placeholder('Masukkan kekuatan santri')
                                        ->columnSpan(2),
                                    Textarea::make('weaknesses')
                                        ->label('Kelemahan')
                                        ->placeholder('Masukkan kelemahan santri')
                                        ->columnSpan(2),
                                ]),
                            ]),
                    ]),
            ])
            ->columnSpanFull()
            ->contained(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('santri.name')
                ->icon('heroicon-m-user')
                ->iconColor('primary')
                ->label('nama santri')
                ->searchable(),
            TextColumn::make('academy_year')
                ->label('Tahun Akademik'),
            TextColumn::make('overall_score')
                ->badge()
                ->Color(function($record) {
                    $rapot = $record->overall_score;
                    if ($rapot <= 100 && $rapot >= 85) {
                        return 'success';
                    }
                    if ($rapot <= 84 && $rapot >= 70) {
                        return 'sky';
                    }
                    if ($rapot <= 69 && $rapot >= 50) {
                        return 'fuchsia';
                    }
                    if ($rapot <= 49) {
                        return 'rose';
                    }
                })
                ->label('Skor Keseluruhan'),
            TextColumn::make('strengths')
                ->label('Kekuatan'),
            TextColumn::make('weaknesses')
                ->label('Kelemahan'),
        ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListRapotSantris::route('/'),
            'create' => Pages\CreateRapotSantri::route('/create'),
            'edit' => Pages\EditRapotSantri::route('/{record}/edit'),
        ];
    }
}
