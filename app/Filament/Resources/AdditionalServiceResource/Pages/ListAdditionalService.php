<?php

namespace App\Filament\Resources\AdditionalServiceResource\Pages;

use App\Filament\Resources\AdditionalServiceResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListAdditionalService extends ListRecords
{
    protected static string $resource = AdditionalServiceResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
