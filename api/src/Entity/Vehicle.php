<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Fees\Association\Association;
use App\Entity\Fees\Basic\Basic;
use App\Entity\Fees\Special\Special;
use App\Entity\Fees\Storage\Storage;
use App\Enum\VehicleTypeEnum;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;
use NumberFormatter;

class Vehicle
{
    private Money $totalPrice;
    private array $fees = [];
    private IntlMoneyFormatter $moneyFormatter;

    public function __construct(
        private Money $basePrice,
        private VehicleTypeEnum $type
    ) {
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter('fr_CA', NumberFormatter::CURRENCY);
        $this->moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);
        $this->totalPrice = $basePrice;
    }

    public function calculatePrice(): void
    {
        $fees = [
            new Basic(),
            new Special(),
            new Association(),
            new Storage(),
        ];

        foreach ($fees as $fee) {
            $feePrice = $fee->calculate($this->basePrice, $this->type);
            $this->fees[$fee->getName()] = $this->moneyFormatter->format($feePrice);
            $this->totalPrice = $this->totalPrice->add($feePrice);
        }
    }

    public function toJson(): array
    {
        return [
            'base_price' => $this->moneyFormatter->format($this->basePrice),
            'fees' => $this->fees,
            'total_price' => $this->moneyFormatter->format($this->totalPrice),
        ];
    }
}
