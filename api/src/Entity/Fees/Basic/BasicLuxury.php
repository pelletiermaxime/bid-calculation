<?php

declare(strict_types=1);

namespace App\Entity\Fees\Basic;

use Money\Money;

class BasicLuxury
{
    public function calculate(Money $fee): Money
    {
        if ($fee->lessThan(Money::CAD(2500))) {
            $fee = Money::CAD(2500);
        }
        if ($fee->greaterThan(Money::CAD(20000))) {
            $fee = Money::CAD(20000);
        }

        return $fee;
    }
}
