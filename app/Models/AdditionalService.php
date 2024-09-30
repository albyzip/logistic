<?php

namespace App\Models;

use App\Enums\CityClassifier;
use App\Enums\SupplyType;
use Illuminate\Database\Eloquent\Model;

class AdditionalService extends Model
{
    protected $fillable = [
      'supply_type',
      'city_classifier',
      'name',
      'price'
    ];

    protected $casts = [
        'city_classifier' => CityClassifier::class,
        'supply_type' => SupplyType::class
    ];
}
