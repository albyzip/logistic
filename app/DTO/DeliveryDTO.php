<?php

namespace App\DTO;

use App\DTO\DeliveryData\SupplierDTO;
use App\DTO\DeliveryData\Supply\AbstractSupplyDTO;

class DeliveryDTO extends AbstractDTO
{
    public ?SupplierDTO $supplier;
    /**
     * @var AbstractSupplyDTO[]
     */
    public array $supply_type = [];
    /**
     * @var AbstractSupplyDTO[]
     */
    public array $supplies = [];
    public array $warehouses = [];
}
