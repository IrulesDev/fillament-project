<?php

namespace App\Filament\Resources\RapotSantriResource\Pages;

use App\Filament\Resources\RapotSantriResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRapotSantri extends CreateRecord
{
    protected static string $resource = RapotSantriResource::class;

    protected function getRedirectUrl(): string{
        return $this->getResource()::getUrl('index', ['record' => $this->getRecord()]);
    }
}
