<?php

namespace App\Filament\Resources\LeasonResource\Pages;

use App\Filament\Resources\LeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeasons extends ListRecords
{
    protected static string $resource = LeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
