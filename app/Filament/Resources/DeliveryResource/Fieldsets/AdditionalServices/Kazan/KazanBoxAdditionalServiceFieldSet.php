<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets\Kazan;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;

class KazanBoxAdditionalServiceFieldSet extends \App\Filament\Structures\AbstractFieldset
{

    public static function get(string $name = '', array $args = []): Fieldset
    {
        $name = 'Дополнительные услуги';
        return Fieldset::make($name)
            ->schema([
                Toggle::make('q')
                    ->label('Забор груза по городу'),
                Toggle::make('w')
                    ->label('Услуга грузчика до 20 коробок'),
                Toggle::make('e')
                    ->label("Услуга 'Региональный забор до 20 км от Казани'"),
                Toggle::make('r')
                    ->label("Услуга 'Региональный забор до 50 км от Казани'")
            ]);
    }
}
