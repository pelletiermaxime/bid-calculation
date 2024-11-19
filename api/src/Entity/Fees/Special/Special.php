<?php

declare(strict_types=1);

namespace App\Entity\Fees\Special;

use App\Entity\Fees\FeeByTypeCalculatorTrait;
use App\Entity\Fees\FeeInterface;
use App\Enum\VehicleTypeEnum;
use Money\Money;

class Special implements FeeInterface
{
    use FeeByTypeCalculatorTrait;

    public function calculate(Money $price, VehicleTypeEnum $type): Money
    {
        $fee = Money::CAD(0);

        return $this->calculateByType($fee, $type);
    }

    public function getName(): string
    {
        return 'Special';
    }
}
