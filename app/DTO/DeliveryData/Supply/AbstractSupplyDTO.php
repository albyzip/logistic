<?php

namespace App\DTO\DeliveryData\Supply;

use App\DTO\DeliveryData\AdditionalService\AbstractAdditionalServiceDTO;

abstract class AbstractSupplyDTO extends \App\DTO\AbstractDTO
{
    public array $additional_services = [];
}
