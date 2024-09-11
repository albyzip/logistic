<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class AuthService
{
    /**
     * Добавить роль пользователю
     * По умолчанию роль 'user'
     */
    public static function assignRole(Model $user, string $role = 'user'): void
    {
        $user->guard_name = 'admin';
        $user->assignRole($role);
    }
}
