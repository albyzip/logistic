<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class BoxSize extends Model
{
    use HasFactory;

    protected $fillable = [
      'width',
      'length',
      'height',
      'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getBoxSizes(): Collection|\Illuminate\Database\Eloquent\Collection|\LaravelIdea\Helper\App\Models\_IH_BoxSize_C
    {
        return self::query()->where('user_id', null)
            ->orWhere('user_id', auth()->user()->id)
            ->get();
    }
}
