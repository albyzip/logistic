<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets;

use App\Enums\CityClassifier;
use App\Enums\SupplyType;
use App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices\AdditionalServicesFieldSet;
use App\Models\City;
use App\Models\PaletWeight;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PalletFieldset extends \App\Filament\Structures\AbstractFieldset
{
    public static function get(string $name = '', array $args = []): Fieldset
    {
        $schema = [
            TextInput::make("supplies.{$args['fieldset_type']->value}.amount")
                ->label('Количество палет')
                ->columnSpan(12)
                ->required(),
            Select::make("supplies.{$args['fieldset_type']->value}.weight")
                ->label('Вес палеты')
                ->columnSpan(12)
                ->options(PaletWeight::query()->get()->pluck('weight', 'id'))
                ->required(),
        ];
        $additionalServices = AdditionalServicesFieldSet::get(
            args: [
                'supply_type' => $args['fieldset_type']
            ]
        );
        if ($additionalServices){
            $schema[] = $additionalServices;
        }
        return Fieldset::make($name)
            ->schema($schema);
    }
}
