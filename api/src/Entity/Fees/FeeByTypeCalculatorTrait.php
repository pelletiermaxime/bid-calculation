<?php

declare(strict_types=1);

namespace App\Entity\Fees;

use App\Enum\VehicleTypeEnum;
use Money\Money;

trait FeeByTypeCalculatorTrait
{
    public function calculateByType(Money $fee, VehicleTypeEnum $type): Money
    {
        $className = __CLASS__ . ucfirst($type->value);
        if (class_exists($className)) {
            $feeCalculator = new $className();
            $fee = $feeCalculator->calculate($fee);
        }

        return $fee;
    }
}
