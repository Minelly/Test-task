<?php

namespace App\Provider;

interface CurrencyRateDataProviderInterface
{
    /**
     * Retrieves the exchange rates from the Exchange Rates API.
     *
     * @return array The 'rates' data from the API response, or an empty array if no data is found.
     */
    public function getRates(): array;
}