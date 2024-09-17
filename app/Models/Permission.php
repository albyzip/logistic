<?php

namespace App\Models;

use Database\Seeders\PermissionSeeder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends \Spatie\Permission\Models\Permission
{
    use SoftDeletes;

    public static function seed(): void
    {
        $seeder = new PermissionSeeder();
        $seeder->run();
    }
}
