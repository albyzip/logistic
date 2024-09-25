<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets;

use App\Enums\CityClassifier;
use App\Enums\SupplyType;
use App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices\Moscow\MoscowPalletAdditionalServiceFieldSet;
use App\Filament\Resources\DeliveryResource\Fieldsets\Kazan\KazanPalletAdditionalServiceFieldSet;
use App\Models\City;
use App\Models\PaletWeight;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PalletFieldset extends \App\Filament\Structures\AbstractFieldset
{
    public static function get(string $name = '', array $args = []): Fieldset
    {
        if (!array_key_exists('pallet_field_name', $args)){
            return Fieldset::make('NO pallet_field_name provided')
                ->schema([]);
        }
        $cities = City::get();
        return Fieldset::make($name)
            ->schema([
                TextInput::make($args['pallet_field_name'])
                    ->label('Количество палет')
                    ->columnSpan(12)
                    ->required(),
                Select::make($args['pallet_field_name'].'_weight')
                    ->label('Вес палеты')
                    ->columnSpan(12)
                    ->options(PaletWeight::query()->get()->pluck('weight', 'id'))
                    ->required(),
                MoscowPalletAdditionalServiceFieldSet::get()
                    ->visible(
                        fn (callable $get) =>
                            $cities->where('id', $get('city_id'))->first()->classifier === CityClassifier::MOSCOW->value
                    ),
                KazanPalletAdditionalServiceFieldSet::get()
                    ->visible(
                        fn (callable $get) =>
                            $cities->where('id', $get('city_id'))->first()->classifier === CityClassifier::KAZAN->value
                    ),
            ]);
    }
}
