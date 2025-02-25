<?php

namespace App\Forms\Components;

use App\Models\Departement;
use App\Models\Classpit;
use Filament\Forms\Components\Select;



class DepartementIdSelect extends Select
{


public static function make(string $name): static
{
    return parent::make($name)
        ->label('Amanah Deaprtment')
        ->prefixIcon('heroicon-o-briefcase')
        ->prefixIconColor('primary')
        ->searchable()
        ->native(false)
        ->options(fn()=> Departement::all()->pluck('name', 'id'));
}

}