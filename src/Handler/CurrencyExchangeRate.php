<?php

namespace App\Handler;

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
        $rate = $rates[$currency] ?? 0;

        return $rate > 0 ? $amount / $rate : $amount;
    }
}