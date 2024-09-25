<?php

namespace App\Filament\Resources\DeliveryResource\Fieldsets;

use App\Enums\LegalType;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class PersonalInformationFieldset extends \App\Filament\Structures\AbstractFieldset
{

    public static function get(string $name = '', array $args = []): Fieldset
    {
        return Fieldset::make($name)
            ->schema([
                TextInput::make('organisation_name'),
                Select::make('organisation_type')
                    ->options(LegalType::toArray()),
                TextInput::make('full_name'),
                TextInput::make('email'),
                TextInput::make('phone'),
                TextInput::make('inn')
            ]);
    }
}
