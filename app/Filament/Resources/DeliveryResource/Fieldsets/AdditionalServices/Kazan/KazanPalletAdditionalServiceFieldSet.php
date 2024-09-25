<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets\Kazan;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;

class KazanPalletAdditionalServiceFieldSet extends \App\Filament\Structures\AbstractFieldset
{

    public static function get(string $name = '', array $args = []): Fieldset
    {
        $name = 'Дополнительные услуги';
        return Fieldset::make($name)
            ->schema([
                Toggle::make('d')
                    ->label("Паллета"),
                Toggle::make('f')
                    ->label("Паллетирование"),
                Toggle::make('g')
                    ->label("Забор груза по городу"),
                Toggle::make('h')
                    ->label("Услуга грузчика до 20 коробок"),
                Toggle::make('j')
                    ->label("Услуга грузчика от 21 коробки "),
                Toggle::make('k')
                    ->label("Услуга 'Региональный забор до 20 км от Казани'"),
                Toggle::make('l')
                    ->label("Услуга 'Региональный забор до 50 км от Казани'"),
            ]);
    }
}
