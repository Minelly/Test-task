<?php

namespace App\Handler;

interface CurrencyExchangeInterface
{
    /**
     * Converts the given amount from the specified currency to EUR.
     *
     * @param string $currency The currency code of the amount to be converted (e.g. 'USD', 'GBP').
     * @param float $amount The amount to be converted to EUR.
     * @return float The converted amount in EUR. If the currency is already EUR or if the conversion rate is not available, the original amount is returned.
     */
    public function convertToEur(string $currency, float $amount): float;
}