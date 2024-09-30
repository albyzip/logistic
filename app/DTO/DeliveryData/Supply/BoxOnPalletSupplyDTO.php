<?php

namespace App\DTO\DeliveryData\Supply;

class BoxOnPalletSupplyDTO extends AbstractSupplyDTO
{
    public array $box_sizes = [];
    public array $box_amounts = [];
}
