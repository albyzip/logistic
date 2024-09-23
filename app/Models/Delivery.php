<?php

namespace App\Models;

use App\DTO\DeliveryDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property DeliveryDTO $data
 */
class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'get_from_address',
        'from_warehouse_id',
        'to_warehouse_id',
        'packaging_unit',
        'package_quantity',
        'unload_at',
        'price',
        'comment',
    ];

    protected $casts = [
        'data' => DeliveryDTO::class
    ];

    public function cargos(): HasMany
    {
        return $this->hasMany(Cargo::class);
    }

    public function entities()
    {
        return $this->hasManyThrough(
            Model::class,
            DeliveryItem::class,
            'delivery_id',
            'id',
            'id',
            'entity_id'
        )->morphTo();
    }
}
