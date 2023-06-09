<?php

namespace App\Calculator;

use App\Exception\CurrencyRateNotFoundException;

interface TransactionFeeCalculatorInterface
{
    /**
     * Calculates the transaction fee for a given Bank Identification Number (BIN), currency, and amount.
     *
     * @param string $bin The Bank Identification Number to look up.
     * @param string $currency The 3-letter currency code of the transaction.
     * @param float $amount The transaction amount.
     * @return float The calculated fee, rounded to 2 decimal places.
     * @throws CurrencyRateNotFoundException If the exchange rate for the specified currency is not found.
     */
    public function calculateFee(string $bin, string $currency, float $amount): float;
}