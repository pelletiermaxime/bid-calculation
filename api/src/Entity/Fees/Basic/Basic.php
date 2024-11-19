<?php

declare(strict_types=1);

namespace App\Entity\Fees\Basic;

use App\Entity\Fees\FeeByTypeCalculatorTrait;
use App\Entity\Fees\FeeInterface;
use App\Enum\VehicleTypeEnum;
use Money\Money;

class Basic implements FeeInterface
{
    use FeeByTypeCalculatorTrait;

    public function calculate(Money $price, VehicleTypeEnum $type): Money
    {
        $fee = $price->multiply(0.1);

        return $this->calculateByType($fee, $type);
    }

    public function getName(): string
    {
        return 'Basic';
    }
}
