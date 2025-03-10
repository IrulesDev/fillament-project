<?php

namespace App\Filament\Resources\LeasonResource\Pages;

use App\Filament\Resources\LeasonResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeason extends EditRecord
{
    protected static string $resource = LeasonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
