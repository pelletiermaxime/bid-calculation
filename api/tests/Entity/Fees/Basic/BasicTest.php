<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Basic;

use App\Entity\Fees\Basic\Basic;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(Basic::class)]
class BasicTest extends MockeryTestCase
{
    private Basic&m\MockInterface $basic;

    protected function setUp(): void
    {
        $this->basic = m::mock(Basic::class)->makePartial();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $price, VehicleTypeEnum $type, string $expectedFee): void
    {
        $this->basic->expects()
            ->calculateByType(m::on(fn(Money $priceArg) => $priceArg->equals(Money::CAD($expectedFee))), $type)
            ->andReturn(Money::CAD($expectedFee));

        $this->assertSame($expectedFee, $this->basic->calculate($price, $type)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(1000), VehicleTypeEnum::COMMON, '100'],
            [Money::CAD(5000), VehicleTypeEnum::COMMON, '500'],
            [Money::CAD(10000), VehicleTypeEnum::COMMON, '1000'],
        ];
    }

    public function testGetName(): void
    {
        $this->assertSame('Basic', $this->basic->getName());
    }
}
