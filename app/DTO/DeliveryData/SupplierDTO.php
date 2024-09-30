<?php

namespace App\DTO\DeliveryData;

class SupplierDTO extends \App\DTO\AbstractDTO
{
    public ?int $inn;
    public ?string $organisation_name;
    public ?string $organisation_type;
    public ?string $full_name;
    public ?string $email;
    public ?string $phone;
}
