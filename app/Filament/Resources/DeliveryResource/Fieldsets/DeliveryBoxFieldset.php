<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets;

use App\Enums\CityClassifier;
use App\Enums\SupplyType;
use App\Filament\Structures\AbstractFieldset;
use App\Models\BoxSize;
use App\Models\City;
use App\Traits\Naming;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices\AdditionalServicesFieldSet;
class DeliveryBoxFieldset extends AbstractFieldset
{
    use Naming;
    public static function get(string $name = '', array $args = []): Fieldset
    {
        if (!array_key_exists('fieldset_type', $args)){
            return Fieldset::make('NO fieldset_type provided')
                ->schema([]);
        }
        $boxSizes = BoxSize::getBoxSizes()->map(function (BoxSize $boxSize) {
            $name = "{$boxSize->length}x{$boxSize->height}x{$boxSize->width}";
            return ['id' => $boxSize->id, 'name' => $name];
        })->pluck('name', 'id');

        $schema = [
            Select::make("supplies.{$args['fieldset_type']->value}.box_sizes")
                ->columnSpan(12)
                ->label(self::getTranslation('delivery_fields.box_sizes'))
                ->multiple()
                ->options($boxSizes)
                ->reactive(),
            self::getBoxSizeAmountField($boxSizes, $args),
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

    private static function getBoxSizeAmountField($boxSizes, $args): Group{
        $fields = [];
        foreach ($boxSizes as $id => $name){
            $fields[] = TextInput::make("supplies.{$args['fieldset_type']->value}.box_amounts.{$id}")
                ->label(self::getTranslation('amount').' '.$name)
                ->visible(fn (callable $get) => in_array($id, $get("supplies.{$args['fieldset_type']->value}.box_sizes")))
                ->columnSpan(12)
                ->required();
        }
        return Group::make($fields);
    }
}
