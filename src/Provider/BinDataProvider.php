<?php

namespace App\Provider;


use App\Enum\API\APIEnum;

class BinDataProvider implements BinDataProviderInterface
{
    /**
     * @inheritDoc
     */
    public function getBinDataForBin(string $bin): array
    {
        $binResults = file_get_contents(APIEnum::BIN_LIST->value . $bin) ?? '';

        return json_decode($binResults, true) ?? [];
    }
}