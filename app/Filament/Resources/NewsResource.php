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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
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
                ->required(),
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
                TextColumn::make('title')
                    ->searchable()
                    ->description(fn(News $record):  string => Str::limit($record->content, 50, '...'))
                    ->sortable(),
                ImageColumn::make('gambar')
                    ->searchable()
                    ->sortable(),
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
    
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('title')
                    ->label('Title'),
                TextEntry::make('content')
                    ->label('Content'),
                ImageEntry::make('gambar')
                    ->label('Gambar'),
                TextEntry::make('author')
                    ->label('Author'),
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
