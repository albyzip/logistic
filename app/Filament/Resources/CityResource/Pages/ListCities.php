<?php
namespace App\Filament\Resources\CityResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListCities extends ListRecords
{
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
