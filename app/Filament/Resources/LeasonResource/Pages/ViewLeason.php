<?php

namespace App\Filament\Resources\LeasonResource\Pages;

use App\Filament\Resources\LeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLeason extends ViewRecord
{
    protected static string $resource = LeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
