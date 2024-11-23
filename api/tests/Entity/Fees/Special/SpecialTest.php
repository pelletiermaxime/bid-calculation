<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Special;

use App\Entity\Fees\Special\Special;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use Mockery as m;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;

#[CoversClass(Special::class)]
class SpecialTest extends MockeryTestCase
{
    private Special&m\MockInterface $special;

    protected function setUp(): void
    {
        $this->special = m::mock(Special::class)->makePartial()->shouldAllowMockingProtectedMethods();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $price, VehicleTypeEnum $type): void
    {
        $this->special->expects()
            ->calculateByType(m::on(fn(Money $priceArg) => $priceArg->equals($price)), $type)
            ->andReturn($price);

        $this->assertSame($price, $this->special->calculate($price, $type));
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(1000), VehicleTypeEnum::COMMON],
            [Money::CAD(5000), VehicleTypeEnum::COMMON],
            [Money::CAD(10000), VehicleTypeEnum::COMMON],
        ];
    }

    public function testGetName(): void
    {
        $this->assertSame('Special', $this->special->getName());
    }
}
