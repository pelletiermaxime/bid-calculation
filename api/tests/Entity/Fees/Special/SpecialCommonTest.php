<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Special;

use App\Entity\Fees\Special\SpecialCommon;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(SpecialCommon::class)]
class SpecialCommonTest extends TestCase
{
    private SpecialCommon $specialCommon;

    protected function setUp(): void
    {
        $this->specialCommon = new SpecialCommon();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $fee, string $expectedFee): void
    {
        $this->assertSame($expectedFee, $this->specialCommon->calculate($fee)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(500), '10'],
            [Money::CAD(1000), '20'],
            [Money::CAD(3000), '60'],
            [Money::CAD(5000), '100'],
            [Money::CAD(6000), '120'],
        ];
    }
}
