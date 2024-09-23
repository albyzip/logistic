<?php

namespace App\Filament\Resources\PaletWeightResource\Pages;

use App\Filament\Resources\PaletWeightResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListPaletWeight extends ListRecords
{
    protected static string $resource = PaletWeightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
