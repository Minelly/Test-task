<?php

namespace App\Handler;

use App\Exception\CurrencyRateNotFoundException;
use App\Provider\CurrencyRateDataProviderInterface;

class CurrencyExchangeRate implements CurrencyExchangeInterface
{
    protected CurrencyRateDataProviderInterface $currencyRateDataProvider;

    public function __construct(CurrencyRateDataProviderInterface $currencyRateDataProvider)
    {
        $this->currencyRateDataProvider = $currencyRateDataProvider;
    }

    /**
     * @inheritdoc
     */
    public function convertToEur(string $currency, float $amount): float
    {
        if ($currency === 'EUR') {
            return $amount;
        }

        $rates = $this->currencyRateDataProvider->getRates();

        if (!isset($rates[$currency])) {
            throw new CurrencyRateNotFoundException($currency);
        }

        $rate = $rates[$currency];

        return $amount / $rate;
    }
}