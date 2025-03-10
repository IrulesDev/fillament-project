<?php

namespace App\Filament\Resources;

use Dom\Text;
use Filament\Forms;
use App\Models\News;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Tabs;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Stack;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\NewsResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\NewsResource\RelationManagers;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'News';
    protected static ?string $pluralLabel = 'News';
    protected static ?string $slug = 'news';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Title'),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->label('Content'),
                Forms\Components\FileUpload::make('gambar')
                    ->required()
                    ->storeFileNamesIn('gambar')
                    ->multiple(),
                Forms\Components\TextInput::make('author')
                    ->default(auth()->user()->name)
                    ->required()
                    ->label('Author'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    TextColumn::make('title')
                        ->searchable()
                        ->description(fn(News $record) => collect(str_split($record->content, 10))->join("\n"))
                        ->sortable(),
                    TextColumn::make('autor.name')
                        ->searchable()
                        ->sortable(),
                ])->extraAttributes([
                    'class' => 'space-y-1', // memberi jarak vertikal antar-elemen
                ]),

                ImageColumn::make('gambar')
                    ->searchable()
                    ->sortable()
                    ->width('200px')
                    ->alignRight()
                    ->height('300px'),

            ])->contentGrid([
                'md' => 2,
                'xl' => 2,
            ])
            ->emptyStateHeading('tidak ada berita')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }



public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Tabs::make('News Categories')
                ->tabs([
                    Tabs\Tab::make('Latest News')
                        ->icon('heroicon-o-newspaper')
                        ->schema([
                            Section::make('Main Details')
                                ->schema([
                                    Grid::make(2)
                                        ->schema([
                                            TextEntry::make('title')
                                                ->label('Title')
                                                ->columnSpan(2),
                                            ImageEntry::make('gambar')
                                                ->label('Image')
                                                ->columnSpan(1)
                                                ->height('300px')
                                                ->width('200px'),
                                            TextEntry::make('autor.name')
                                                ->label('Author')
                                                ->columnSpan(1),
                                        ]),
                                ]),
                            Section::make('Content')
                                ->schema([
                                    TextEntry::make('content')
                                        ->label('Content')
                                        ->columnSpan(2),
                                ]),
                        ]),
                    // Tambahkan tab lain sesuai kebutuhan
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'view' => Pages\ViewNews::route('/{record}'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
