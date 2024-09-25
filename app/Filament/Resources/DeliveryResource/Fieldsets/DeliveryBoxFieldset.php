<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets;

use App\Enums\CityClassifier;
use App\Enums\SupplyType;
use App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices\Moscow\MoscowBoxAdditionalServiceFieldSet;
use App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices\Moscow\MoscowBoxOnPalletAdditionalServiceFieldSet;
use App\Filament\Resources\DeliveryResource\Fieldsets\Kazan\KazanBoxAdditionalServiceFieldSet;
use App\Filament\Resources\DeliveryResource\Fieldsets\Kazan\KazanBoxOnPalletAdditionalServiceFieldSet;
use App\Filament\Structures\AbstractFieldset;
use App\Models\BoxSize;
use App\Models\City;
use App\Traits\Naming;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class DeliveryBoxFieldset extends AbstractFieldset
{
    use Naming;
    public static function get(string $name = '', array $args = []): Fieldset
    {
        if (!array_key_exists('box_sizes_field_name', $args)){
            return Fieldset::make('NO box_sizes_field_name provided')
                ->schema([]);
        }
        if (!array_key_exists('fieldset_type', $args)){
            return Fieldset::make('NO fieldset_type provided')
                ->schema([]);
        }
        $cities = City::get();
        $boxSizes = BoxSize::getBoxSizes()->map(function (BoxSize $boxSize) {
            $name = "{$boxSize->length}x{$boxSize->height}x{$boxSize->width}";
            return ['id' => $boxSize->id, 'name' => $name];
        })->pluck('name', 'id');
        return Fieldset::make($name)
            ->schema([
                Select::make($args['box_sizes_field_name'])
                    ->columnSpan(12)
                    ->label(self::getTranslation('delivery_fields.box_sizes'))
                    ->multiple()
                    ->options($boxSizes)
                    ->reactive(),
                self::getBoxSizeAmountField($boxSizes, $args['box_sizes_field_name']),
                MoscowBoxAdditionalServiceFieldSet::get()
                    ->visible(
                        fn (callable $get) =>
                        $cities->where('id', $get('city_id'))->first()->classifier === CityClassifier::MOSCOW->value
                        && in_array(SupplyType::BOX->name, $get('supply_type'))
                        && $args['fieldset_type'] === SupplyType::BOX->name
                    ),
                KazanBoxAdditionalServiceFieldSet::get()
                    ->visible(
                        fn (callable $get) =>
                            $cities->where('id', $get('city_id'))->first()->classifier === CityClassifier::KAZAN->value
                            && in_array(SupplyType::BOX->name, $get('supply_type'))
                            && $args['fieldset_type'] === SupplyType::BOX->name
                    ),
                MoscowBoxOnPalletAdditionalServiceFieldSet::get()
                    ->visible(
                        fn (callable $get) =>
                            $cities->where('id', $get('city_id'))->first()->classifier === CityClassifier::MOSCOW->value
                            && in_array(SupplyType::BOX_ON_PALLET->name, $get('supply_type'))
                            && $args['fieldset_type'] === SupplyType::BOX_ON_PALLET->name
                    ),
                KazanBoxOnPalletAdditionalServiceFieldSet::get()
                    ->visible(
                        fn (callable $get) =>
                            $cities->where('id', $get('city_id'))->first()->classifier === CityClassifier::KAZAN->value
                            && in_array(SupplyType::BOX_ON_PALLET->name, $get('supply_type'))
                            && $args['fieldset_type'] === SupplyType::BOX_ON_PALLET->name
                    ),
            ]);
    }

    private static function getBoxSizeAmountField($boxSizes, $fieldName): Group{
        $fields = [];
        foreach ($boxSizes as $id => $name){
            $fields[] = TextInput::make($fieldName.'_'.$id)
                ->label(self::getTranslation('amount').' '.$name)
                ->visible(fn (callable $get) => in_array($id, $get($fieldName)))
                ->columnSpan(12)
                ->required();
        }
        return Group::make($fields);
    }
}
