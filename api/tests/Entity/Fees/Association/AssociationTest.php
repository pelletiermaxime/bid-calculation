<?php

declare(strict_types=1);

namespace App\Tests\Entity\Fees\Association;

use App\Entity\Fees\Association\Association;
use App\Enum\VehicleTypeEnum;
use Money\Money;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(Association::class)]
class AssociationTest extends TestCase
{
    private Association $association;

    protected function setUp(): void
    {
        $this->association = new Association();
    }

    #[DataProvider('calculateProvider')]
    public function testCalculate(Money $price, string $expectedFee): void
    {
        $this->assertSame($expectedFee, $this->association->calculate($price, VehicleTypeEnum::COMMON)->getAmount());
    }

    public static function calculateProvider(): array
    {
        return [
            [Money::CAD(50), '0'],
            [Money::CAD(150), '500'],
            [Money::CAD(60000), '1000'],
            [Money::CAD(150000), '1500'],
            [Money::CAD(350000), '2000'],
        ];
    }

    public function testGetName(): void
    {
        $this->assertSame('Association', $this->association->getName());
    }
}
