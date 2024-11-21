<?php

declare(strict_types=1);

namespace App\Entity\Fees;

use Money\Money;

interface FeeTypeInterface
{
    public function calculate(Money $fee): Money;
}
