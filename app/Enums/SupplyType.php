<?php

namespace App\Enums;

use App\DTO\DeliveryData\Supply\AbstractSupplyDTO;
use App\DTO\DeliveryData\Supply\BoxOnPalletSupplyDTO;
use App\DTO\DeliveryData\Supply\BoxSupplyDTO;
use App\DTO\DeliveryData\Supply\PalletSupplyDTO;
use App\Traits\Naming;

enum SupplyType: string
{
    case BOX = 'box';
    case BOX_ON_PALLET = 'box_on_pallet';
    case PALLET1 = 'pallet1';
    case PALLET2 = 'pallet2';
    case PALLET3 = 'pallet3';

    static function forSelect(): array{
        $cases = [];
        foreach (self::cases() as $case){
            $cases[$case->value] = self::getName($case);
        }
        return $cases;
    }

    static function getSupplyDTO($case): string|AbstractSupplyDTO{
        return match ($case){
            self::BOX => BoxSupplyDTO::class,
            self::BOX_ON_PALLET => BoxOnPalletSupplyDTO::class,
            self::PALLET1, self::PALLET2, self::PALLET3 => PalletSupplyDTO::class
        };
    }

    static function getName($case): string{
        return match ($case){
            self::BOX => 'Короба',
            self::BOX_ON_PALLET => 'Короба на палете',
            self::PALLET1 => 'Палета с одним артикулом',
            self::PALLET2 => 'Палета с двумя артикулами',
            self::PALLET3 => 'Палета с тремя артикулами'
        };
    }
}
