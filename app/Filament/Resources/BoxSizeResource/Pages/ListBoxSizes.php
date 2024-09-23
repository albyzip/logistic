<?php
namespace App\Filament\Resources\BoxSizeResource\Pages;

use App\Filament\Resources\BoxSizeResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions;

class ListBoxSizes extends ListRecords
{
    protected static string $resource = BoxSizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
