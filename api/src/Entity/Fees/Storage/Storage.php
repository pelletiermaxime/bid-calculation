<?php

declare(strict_types=1);

namespace App\Entity\Fees\Storage;

use App\Entity\Fees\FeeInterface;
use Money\Money;

class Storage implements FeeInterface
{
    public function calculate(Money $price, string $type): Money
    {
        return Money::CAD(10000);
    }

    public function getName(): string
    {
        return 'Storage';
    }
}
