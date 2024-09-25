<?php

namespace App\Filament\Structures;

use Filament\Forms\Components\Fieldset;

abstract class AbstractFieldset
{
    abstract public static function get(string $name = '', array $args = []): Fieldset;
}
