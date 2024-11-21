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
        return $this->calculateByType($price, $type);
    }

    public function getName(): string
    {
        return 'Special';
    }
}
