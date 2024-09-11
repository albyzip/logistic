<?php

namespace App\Models;

use App\Observers\SlugObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(SlugObserver::class)]
class Warehouse extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'slug',
    ];
}
