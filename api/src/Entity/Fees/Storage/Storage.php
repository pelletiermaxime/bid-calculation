<?php

declare(strict_types=1);

namespace App\Entity\Fees\Storage;

use App\Entity\Fees\FeeInterface;
use App\Enum\VehicleTypeEnum;
use Money\Money;

class Storage implements FeeInterface
{
    public function calculate(Money $price, VehicleTypeEnum $type): Money
    {
        return Money::CAD(10000);
    }

    public function getName(): string
    {
        return 'Storage';
    }
}
