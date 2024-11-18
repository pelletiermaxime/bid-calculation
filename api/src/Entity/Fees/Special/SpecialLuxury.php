<?php

declare(strict_types=1);

namespace App\Entity\Fees\Special;

use Money\Money;

class SpecialLuxury
{
    public function calculate(Money $fee): Money
    {
        return $fee->multiply(0.04);
    }
}
