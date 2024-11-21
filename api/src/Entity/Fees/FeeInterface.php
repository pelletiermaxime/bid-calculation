<?php

declare(strict_types=1);

namespace App\Entity\Fees;

use App\Enum\VehicleTypeEnum;
use Money\Money;

interface FeeInterface
{
    public function calculate(Money $price, VehicleTypeEnum $type): Money;

    public function getName(): string;
}
