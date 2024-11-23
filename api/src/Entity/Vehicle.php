<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Fees\FeeInterface;
use App\Enum\VehicleTypeEnum;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

class Vehicle
{
    private Money $totalPrice;
    private array $calculatedFees = [];
    private Money $basePrice;
    private VehicleTypeEnum $type;

    /**
     * @param array<FeeInterface> $fees
     */
    public function __construct(private readonly IntlMoneyFormatter $moneyFormatter, private readonly array $fees)
    {
        $this->totalPrice = Money::CAD(0);
    }

    public function calculatePrice(): void
    {
        $this->totalPrice = $this->basePrice;

        foreach ($this->fees as $fee) {
            $feePrice = $fee->calculate($this->basePrice, $this->type);
            $this->calculatedFees[$fee->getName()] = $this->moneyFormatter->format($feePrice);
            $this->totalPrice = $this->totalPrice->add($feePrice);
        }
    }

    public function toJson(): array
    {
        return [
            'base_price' => $this->moneyFormatter->format($this->basePrice),
            'fees' => $this->calculatedFees,
            'total_price' => $this->moneyFormatter->format($this->totalPrice),
        ];
    }

    public function setBasePrice(Money $basePrice): void
    {
        $this->basePrice = $basePrice;
    }

    public function setType(VehicleTypeEnum $type): void
    {
        $this->type = $type;
    }
}
