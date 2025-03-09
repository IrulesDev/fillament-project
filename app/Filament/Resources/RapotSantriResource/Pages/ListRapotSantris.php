<?php

namespace App\Filament\Resources\RapotSantriResource\Pages;

use App\Filament\Resources\RapotSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRapotSantris extends ListRecords
{
    protected static string $resource = RapotSantriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
