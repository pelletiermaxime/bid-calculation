<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Storage;

use App\Entity\Fees\Storage\Storage;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Storage::class)]
class StorageTest extends TestCase
{
    private Storage $storage;

    protected function setUp(): void
    {
        $this->storage = new Storage();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $price, VehicleTypeEnum $type, string $expectedFee): void
    {
        $this->assertSame($expectedFee, $this->storage->calculate($price, $type)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(1000), VehicleTypeEnum::COMMON, '10000'],
            [Money::CAD(5000), VehicleTypeEnum::LUXURY, '10000'],
            [Money::CAD(10000), VehicleTypeEnum::COMMON, '10000'],
        ];
    }

    public function testGetName(): void
    {
        $this->assertSame('Storage', $this->storage->getName());
    }
}
