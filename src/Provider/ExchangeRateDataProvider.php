<?php

namespace App\Provider;

use App\Enum\API\APIEnum;

class ExchangeRateDataProvider implements CurrencyRateDataProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getRates(): array
    {
        $data = file_get_contents(APIEnum::EXCHANGE_REST_API->value) ?? '';
        $rates = json_decode($data, true) ?? [];

        return $rates['rates'] ?? [];
    }
}