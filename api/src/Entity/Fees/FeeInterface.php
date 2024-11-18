<?php

declare(strict_types=1);

namespace App\Entity\Fees;

use Money\Money;

interface FeeInterface
{
    public function calculate(Money $price, string $type): Money;
    public function getName(): string;
}
