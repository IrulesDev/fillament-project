<?php

namespace App\Filament\Resources\AtandanceResource\Pages;

use App\Filament\Resources\AtandanceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAtandance extends EditRecord
{
    protected static string $resource = AtandanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
