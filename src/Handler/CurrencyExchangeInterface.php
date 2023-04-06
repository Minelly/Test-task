<?php

namespace App\Handler;

use App\Exception\CurrencyRateNotFoundException;

interface CurrencyExchangeInterface
{
    /**
     * Converts the given amount from the specified currency to EUR.
     * @param string $currency The currency code of the amount to be converted.
     * @param float $amount The amount to be converted.
     * @return float The converted amount in EUR.
     * @throws CurrencyRateNotFoundException If the exchange rate for the specified currency is not found.
     */
    public function convertToEur(string $currency, float $amount): float;
}