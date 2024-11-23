<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Special;

use App\Entity\Fees\Special\SpecialLuxury;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(SpecialLuxury::class)]
class SpecialLuxuryTest extends TestCase
{
    private SpecialLuxury $specialLuxury;

    protected function setUp(): void
    {
        $this->specialLuxury = new SpecialLuxury();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $fee, string $expectedFee): void
    {
        $this->assertSame($expectedFee, $this->specialLuxury->calculate($fee)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(500), '20'],
            [Money::CAD(1000), '40'],
            [Money::CAD(3000), '120'],
            [Money::CAD(5000), '200'],
            [Money::CAD(6000), '240'],
        ];
    }
}
