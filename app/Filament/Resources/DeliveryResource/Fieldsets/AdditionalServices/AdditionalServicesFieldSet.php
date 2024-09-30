<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices;

use App\Enums\SupplyType;
use App\Filament\Structures\AbstractFieldset;
use App\Models\AdditionalService;
use App\Models\City;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;

class AdditionalServicesFieldSet extends AbstractFieldset
{

    public static function get(string $name = '', array $args = []): ?Fieldset
    {
        $schema = self::getSchema($args);
        return Fieldset::make('Дополнительные услуги')
            ->schema(
                $schema
            );
    }

    protected static function getSchema(array $args): array
    {
        /** @var SupplyType $supplyType */
        $supplyType = $args['supply_type'];
        $additionalServices = AdditionalService::query()
            ->where('supply_type', $supplyType)
            ->get();
        $schema = [];

        foreach ($additionalServices as $service){
            $schema[] = Toggle::make(
                "supplies.{$supplyType->value}.additional_services.$service->id"
            )
                ->label($service->name)
                ->visible(
                    fn (callable $get) =>
                        City::whereId($get('city_id'))->first()->classifier === $service->city_classifier->value
                );
        }

        return $schema;
    }
}
