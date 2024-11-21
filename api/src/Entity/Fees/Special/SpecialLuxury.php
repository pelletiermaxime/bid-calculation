<?php

declare(strict_types=1);

namespace App\Entity\Fees\Special;

use App\Entity\Fees\FeeTypeInterface;
use Money\Money;

class SpecialLuxury implements FeeTypeInterface
{
    public function calculate(Money $fee): Money
    {
        return $fee->multiply(0.04);
    }
}
