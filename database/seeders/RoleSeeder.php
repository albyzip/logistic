<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([
            [
                'name' => 'superuser',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'client',
                'guard_name' => 'admin',
            ],
            [
                'name' => 'manager',
                'guard_name' => 'admin',
            ],
        ]);

        $roles->each(function ($role): void {
            Role::create($role);
        });
    }
}
