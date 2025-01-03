<?php

declare(strict_types=1);

namespace App\Entity\Fees\Association;

use App\Entity\Fees\FeeInterface;
use App\Enum\VehicleTypeEnum;
use Money\Money;

class Association implements FeeInterface
{
    public function calculate(Money $price, VehicleTypeEnum $type): Money
    {
        $fee = Money::CAD(0);

        if ($price->greaterThan(Money::CAD(100)) && $price->lessThan(Money::CAD(50000))) {
            $fee = Money::CAD(500);
        } elseif ($price->greaterThan(Money::CAD(50000)) && $price->lessThan(Money::CAD(100000))) {
            $fee = Money::CAD(1000);
        } elseif ($price->greaterThan(Money::CAD(100000)) && $price->lessThan(Money::CAD(300000))) {
            $fee = Money::CAD(1500);
        } elseif ($price->greaterThan(Money::CAD(300000))) {
            $fee = Money::CAD(2000);
        }

        return $fee;
    }

    public function getName(): string
    {
        return 'Association';
    }
}
