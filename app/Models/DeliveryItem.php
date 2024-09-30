<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_id',
        'entity_type',
        'entity_id',
        'amount'
    ];

    public function entity()
    {
        return $this->morphTo();
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
