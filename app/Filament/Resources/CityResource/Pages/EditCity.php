<?php

namespace App\Filament\Resources\CityResource\Pages;

use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CityResource;
use Filament\Actions;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
