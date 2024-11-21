<?php

declare(strict_types=1);

namespace App\Entity\Fees\Basic;

use App\Entity\Fees\FeeTypeInterface;
use Money\Money;

class BasicCommon implements FeeTypeInterface
{
    public function calculate(Money $fee): Money
    {
        if ($fee->lessThan(Money::CAD(1000))) {
            $fee = Money::CAD(1000);
        }
        if ($fee->greaterThan(Money::CAD(5000))) {
            $fee = Money::CAD(5000);
        }

        return $fee;
    }
}
