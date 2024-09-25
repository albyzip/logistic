<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets\AdditionalServices\Moscow;

use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Toggle;

class MoscowBoxOnPalletAdditionalServiceFieldSet extends \App\Filament\Structures\AbstractFieldset
{

    public static function get(string $name = '', array $args = []): Fieldset
    {
        $name = 'Дополнительные услуги';
        return Fieldset::make($name)
            ->schema([
                Toggle::make('x')
                    ->label("Паллета"),
                Toggle::make('c')
                    ->label("Паллетирование (от 8 коробок обязательно)"),
            ]);
    }
}
