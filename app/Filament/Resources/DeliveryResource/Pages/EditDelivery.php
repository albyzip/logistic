<?php

namespace App\Filament\Resources\DeliveryResource\Pages;

use App\DTO\DeliveryData\SupplierDTO;
use App\DTO\DeliveryDTO;
use App\Enums\SupplyType;
use App\Filament\Resources\DeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditDelivery extends EditRecord
{
    protected static string $resource = DeliveryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $model = $record;
        $model->comment = $data['comment'] ?? null;
        $model->unload_at = $data['unload_at'] ?? null;
        $model->city_id = $data['city_id'];
        $model->data = new DeliveryDTO([]);
        $model->data->warehouses = $data['to_warehouse_id'] ?? [];
        $model->data->supply_type = $data['supply_type'];
        foreach ($data['supplies'] ?? [] as $key => $value){
            $model->data->supplies[$key] = new (SupplyType::getSupplyDTO(SupplyType::from($key)))();
            $model->data->supplies[$key]->additional_services = $value['additional_services'] ?? [];
            foreach ($value as $subKey => $subValue){
                if ($subKey === 'additional_services')
                    continue;
                $model->data->supplies[$key]->{$subKey} = $subValue;
            }
        }
        $model->data->supplier = new SupplierDTO();
        $model->data->supplier->phone = $data['phone'] ?? null;
        $model->data->supplier->inn = $data['inn'] ?? null;
        $model->data->supplier->email = $data['email'] ?? null;
        $model->data->supplier->full_name = $data['full_name'] ?? null;
        $model->data->supplier->organisation_name = $data['organisation_name'] ?? null;
        $model->data->supplier->organisation_type = $data['organisation_type'] ?? null;
        $model->save();
        return $model;
    }

    public function mount($record): void
    {
        parent::mount($record);
        $model = $this->getRecord();
        /** @var DeliveryDTO $data */
        $data = $model->data;
        $this->form->fill([
            'data' => $model->data->toArray(),
            'city_id' => $model->city_id,
            'to_warehouse_id' => $model->data->warehouses,
            'supply_type' => $model->data->supply_type,
            'unload_at' => $model->unload_at,
            'comment' => $model->comment,
            'phone' => $data->supplier->phone,
            'inn' => $data->supplier->inn,
            'email' => $data->supplier->email,
            'full_name' => $data->supplier->full_name,
            'organisation_type' => $data->supplier->organisation_type,
            'organisation_name' => $data->supplier->organisation_name,
            'supplies' => $data->supplies
        ]);
    }
}
