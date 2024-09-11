<?php

namespace App\Observers;

use Illuminate\Support\Str;

class SlugObserver
{
    public function creating($model) {
        $model->slug = Str::slug($model->name, '-');
    }
}
