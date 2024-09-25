<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets\Kazan;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;

class KazanBoxOnPalletAdditionalServiceFieldSet extends \App\Filament\Structures\AbstractFieldset
{

    public static function get(string $name = '', array $args = []): Fieldset
    {
        $name = 'Дополнительные услуги';
        return Fieldset::make($name)
            ->schema([
                Toggle::make('t')
                    ->label("Забор груза по городу, до 10 коробок"),
                Toggle::make('y')
                    ->label("Забор груза по городу более 10 коробок или паллеты"),
                Toggle::make('u')
                    ->label("Услуга грузчика до 20 коробок"),
                Toggle::make('i')
                    ->label("Услуга грузчика от 21 коробки"),
                Toggle::make('o')
                    ->label("Паллета"),
                Toggle::make('p')
                    ->label("Паллетирование"),
                Toggle::make('a')
                    ->label("Услуга 'Региональный забор до 20 км от Казани'"),
                Toggle::make('s')
                    ->label("Услуга 'Региональный забор до 50 км от Казани'"),
            ]);
    }
}
