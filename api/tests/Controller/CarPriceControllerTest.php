<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Controller\CarPriceController;
use App\Entity\Vehicle;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use Mockery as m;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

#[CoversClass(CarPriceController::class)]
class CarPriceControllerTest extends KernelTestCase
{
    private CarPriceController $controller;
    private Vehicle&m\MockInterface $vehicleMock;

    public function setUp(): void
    {
        self::bootKernel();
        $this->vehicleMock = m::mock(Vehicle::class);
        $this->controller = new CarPriceController($this->vehicleMock);
        $this->controller->setContainer(self::getContainer());
    }

    protected function tearDown(): void
    {
        m::close();
    }

    public function testCalculateCarPriceValid(): void
    {
        $this->vehicleMock->expects()->setBasePrice(m::on(function (Money $arg) {
            return $arg->equals(Money::CAD('100000'));
        }));
        $this->vehicleMock->expects()->setType(VehicleTypeEnum::COMMON);
        $this->vehicleMock->expects()->calculatePrice();
        $this->vehicleMock->expects()->toJson()->andReturn(['totalPrice' => '1000']);

        $response = $this->controller->calculateCarPrice('100000', 'common');

        $this->assertSame(200, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertIsString($content);
        $this->assertSame(['totalPrice' => '1000'], json_decode($content, true));
    }

    public function testCalculateCarPriceInvalidPrice(): void
    {
        $this->vehicleMock = m::mock(Vehicle::class);

        $response = $this->controller->calculateCarPrice('invalid', 'common');

        $this->assertSame(400, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertIsString($content);
        $this->assertSame(['error' => 'Invalid price'], json_decode($content, true));
    }

    public function testCalculateCarPriceInvalidType(): void
    {
        $this->vehicleMock = m::mock(Vehicle::class);

        $response = $this->controller->calculateCarPrice('1000', 'INVALID_TYPE');

        $this->assertSame(400, $response->getStatusCode());
        $content = $response->getContent();
        $this->assertIsString($content);
        $this->assertSame(['error' => 'Invalid type'], json_decode($content, true));
    }
}
