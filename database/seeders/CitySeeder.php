<?php

namespace Database\Seeders;

use App\Enums\CityClassifier;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::create([
            'name' => 'Москва',
            'classifier' => CityClassifier::MOSCOW->value
        ]);
        City::create([
            'name' => 'Казань',
            'classifier' => CityClassifier::KAZAN->value
        ]);
    }
}
