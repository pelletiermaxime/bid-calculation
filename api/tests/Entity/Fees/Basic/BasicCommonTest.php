<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Basic;

use App\Entity\Fees\Basic\BasicCommon;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(BasicCommon::class)]
class BasicCommonTest extends TestCase
{
    private BasicCommon $basicCommon;

    protected function setUp(): void
    {
        $this->basicCommon = new BasicCommon();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $fee, string $expectedFee): void
    {
        $this->assertSame($expectedFee, $this->basicCommon->calculate($fee)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(500), '1000'],
            [Money::CAD(1000), '1000'],
            [Money::CAD(3000), '3000'],
            [Money::CAD(5000), '5000'],
            [Money::CAD(6000), '5000'],
        ];
    }
}
