<?php

declare(strict_types=1);

namespace App\Entity\Fees\Special;

use App\Entity\Fees\FeeInterface;
use Money\Money;

class Special implements FeeInterface
{
    public function calculate(Money $price, string $type): Money
    {
        $fee = Money::CAD(0);

        $className = __CLASS__ . ucfirst($type);
        if (class_exists($className)) {
            $feeCalculator = new $className();
            $fee = $feeCalculator->calculate($price);
        }

        return $fee;
    }

    public function getName(): string
    {
        return 'Special';
    }
}
