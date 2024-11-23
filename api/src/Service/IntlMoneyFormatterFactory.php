<?php

declare(strict_types=1);

namespace App\Service;

use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use NumberFormatter;

class IntlMoneyFormatterFactory
{
    public static function create(): IntlMoneyFormatter
    {
        $currencies = new ISOCurrencies();
        $numberFormatter = new NumberFormatter('fr_CA', NumberFormatter::CURRENCY);
        return new IntlMoneyFormatter($numberFormatter, $currencies);
    }
}
