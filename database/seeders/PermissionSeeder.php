<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crud = collect([
            'creat',
            'read',
            'update',
            'delete',
        ]);

        $data = collect([
            'delivery',
            'user',
            'user-role',
        ]);

        $data->each(function ($item) use($crud) : void {
            $crud->each(function ($action) use($item) : void {
                Permission::create([
                    'guard_name' => 'admin',
                    'name' => $item . '-' . $action,
                ]);
            });
        });
    }
}
