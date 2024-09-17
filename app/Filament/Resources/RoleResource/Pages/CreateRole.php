<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use App\Models\Permission;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $permissions = $data['permissions'] ?? [];
        $data['guard_name'] = 'admin';
        /** @var Role $model */
        $model = static::getModel();
        $model = $model::create($data);
        $permissions = Permission::query()->whereIn('id', $permissions)->get();
        $model->syncPermissions($permissions);
        return $model;
    }
}
