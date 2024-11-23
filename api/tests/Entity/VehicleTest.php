<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Fees\FeeInterface;
use App\Entity\Vehicle;
use App\Enum\VehicleTypeEnum;
use App\Service\IntlMoneyFormatterFactory;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use Mockery as m;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[CoversClass(Vehicle::class)]
#[CoversClass(IntlMoneyFormatterFactory::class)]
class VehicleTest extends KernelTestCase
{
    private Vehicle $vehicle;
    /** @var m\MockInterface&FeeInterface */
    private FeeInterface $firstFee;

    protected function setUp(): void
    {
        $container = self::getContainer();
        /** @var IntlMoneyFormatter $intlMoneyFormatter */
        $intlMoneyFormatter = $container->get(IntlMoneyFormatterFactory::class);
        $this->firstFee = m::mock(FeeInterface::class);
        $fees = [$this->firstFee];
        $this->vehicle = new Vehicle($intlMoneyFormatter, $fees);
    }

    public function testCalculatePrice(): void
    {
        $basePrice = Money::CAD(110000);
        $this->vehicle->setBasePrice($basePrice);
        $this->vehicle->setType(VehicleTypeEnum::COMMON);

        $this->firstFee->expects()->calculate($basePrice, VehicleTypeEnum::COMMON)->andReturn(Money::CAD(1000));
        $this->firstFee->expects()->getName()->andReturn('Basic');

        $this->vehicle->calculatePrice();

        $expectedFees = [
            'Basic' => "10,00\u{A0}$",
        ];

        $json = $this->vehicle->toJson();

        $this->assertSame("1\u{A0}100,00\u{A0}$", $json['base_price']);
        $this->assertSame($expectedFees, $json['fees']);
        $this->assertSame("1\u{A0}110,00\u{A0}$", $json['total_price']);
    }
}
