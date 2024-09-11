<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum PackagingUnit: string
{
    use EnumHelper;

    case BOX = 'box';
    case PALLET = 'pallet';
}
