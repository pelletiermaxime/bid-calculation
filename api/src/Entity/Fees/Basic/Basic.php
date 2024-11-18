<?php

declare(strict_types=1);

namespace App\Entity\Fees\Basic;

use App\Entity\Fees\FeeInterface;
use Money\Money;

class Basic implements FeeInterface
{

    public function calculate(Money $price, string $type): Money
    {
        $fee = $price->multiply(0.1);

        $className = __CLASS__ . ucfirst($type);
        if (class_exists($className)) {
            $feeCalculator = new $className();
            $fee = $feeCalculator->calculate($fee);
        }

        return $fee;
    }

    public function getName(): string
    {
        return 'Basic';
    }
}
