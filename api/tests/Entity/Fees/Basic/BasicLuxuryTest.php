<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Basic;

use App\Entity\Fees\Basic\BasicLuxury;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(BasicLuxury::class)]
class BasicLuxuryTest extends TestCase
{
    private BasicLuxury $basicLuxury;

    protected function setUp(): void
    {
        $this->basicLuxury = new BasicLuxury();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $fee, string $expectedFee): void
    {
        $this->assertSame($expectedFee, $this->basicLuxury->calculate($fee)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(2000), '2500'],
            [Money::CAD(2500), '2500'],
            [Money::CAD(10000), '10000'],
            [Money::CAD(20000), '20000'],
            [Money::CAD(25000), '20000'],
        ];
    }
}
