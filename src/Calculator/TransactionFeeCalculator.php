<?php

namespace App\Calculator;

use App\Checker\Country\CountryCheckerInterface;
use App\Handler\BinLookupInterface;
use App\Handler\CurrencyExchangeInterface;

class TransactionFeeCalculator implements TransactionFeeCalculatorInterface
{
    protected BinLookupInterface $binLookup;

    protected CurrencyExchangeInterface $currencyConverter;

    protected CountryCheckerInterface $euCountryChecker;

    public function __construct(
        BinLookupInterface $binLookup,
        CurrencyExchangeInterface $currencyConverter,
        CountryCheckerInterface $euCountryChecker
    ) {
        $this->binLookup = $binLookup;
        $this->currencyConverter = $currencyConverter;
        $this->euCountryChecker = $euCountryChecker;
    }

    /**
     * @inheritDoc
     */
    public function calculateFee(string $bin, string $currency, float $amount): float
    {
        $countryCode = $this->binLookup->getCountryCode($bin);
        $isEu = $this->euCountryChecker->checkCountryCode($countryCode);
        $amountEur = $this->currencyConverter->convertToEur($currency, $amount);
        $fee = $this->getFee($amountEur, $isEu);

        return round($fee, 2);
    }

    /**
     * Calculates the transaction fee based on the converted EUR amount and whether the country is in the EU.
     *
     * @param float $amountEur The transaction amount in EUR.
     * @param bool $isEu True if the country is in the EU, false otherwise.
     * @return float The calculated fee.
     */
    protected function getFee(float $amountEur, bool $isEu): float
    {
        return $amountEur * ($isEu ? 0.01 : 0.02);
    }
}