<?php

namespace App\Enums;

use App\Enums\Traits\EnumHelper;

enum LegalType: string
{
    use EnumHelper;

    case OOO = 'ooo';
    case IP = 'ip';
}
