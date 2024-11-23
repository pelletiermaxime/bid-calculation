<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees;

use App\Entity\Fees\Basic\Basic;
use App\Entity\Fees\FeeByTypeCalculatorTrait;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Basic::class)]
class FeeByTypeCalculatorTraitTest extends TestCase
{
    use FeeByTypeCalculatorTrait;

    #[DataProvider('calculateByTypeProvider')]
    public function testCalculateByType(Money $fee, VehicleTypeEnum $type, Money $expectedFee): void
    {
        $result = $this->calculateByType($fee, $type);
        $this->assertTrue($result->equals($expectedFee));
    }

    public static function calculateByTypeProvider(): array
    {
        return [
            [Money::CAD(1000), VehicleTypeEnum::COMMON, Money::CAD(2000)], // Adjusted expected fee
            [Money::CAD(5000), VehicleTypeEnum::LUXURY, Money::CAD(5000)],
            [Money::CAD(10000), VehicleTypeEnum::COMMON, Money::CAD(20000)], // Adjusted expected fee
        ];
    }
}
