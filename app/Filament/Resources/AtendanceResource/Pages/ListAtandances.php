<?php

namespace App\Filament\Resources\AtandanceResource\Pages;

use App\Filament\Resources\AtandanceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAtandances extends ListRecords
{
    protected static string $resource = AtandanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
