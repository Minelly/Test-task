<?php

namespace App\Exception;

use Exception;

class CurrencyRateNotFoundException extends Exception
{
    public function __construct(string $currency)
    {
        parent::__construct("Currency rate not found for: {$currency}");
    }
}