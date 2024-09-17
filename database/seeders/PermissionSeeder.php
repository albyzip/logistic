<?php

namespace Database\Seeders;

use App\Models\Permission;
use Filament\Facades\Filament;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = Route::getRoutes()->getRoutesByName();

        foreach ($routes as $key => $route) {
            if (!str_starts_with($key, 'filament.admin.') || str_starts_with($key, 'filament.admin.auth')) {
                unset($routes[$key]);
            }
        }

        Permission::query()->whereNotIn('key', array_keys($routes))->delete();
        $permissions = Permission::withTrashed()->get();

        foreach ($routes as $key => $route){
            $permission = $permissions->where('name', $key)->first();
            if ($permission->trashed()){
                $permission->restore();
            } else {
                Permission::create([
                    'guard_name' => 'admin',
                    'name' => $key,
                    'display_name' => $key
                ]);
            }
        }
    }
}
