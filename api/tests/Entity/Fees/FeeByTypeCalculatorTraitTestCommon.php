<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees;

use App\Entity\Fees\FeeTypeInterface;
use Money\Money;

class FeeByTypeCalculatorTraitTestCommon implements FeeTypeInterface
{
    public function calculate(Money $fee): Money
    {
        return $fee->multiply(2);
    }
}
