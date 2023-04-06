<?php

namespace App\Provider;

interface BinDataProviderInterface
{
    /**
     * Retrieves the BIN data for the given Bank Identification Number (BIN) from the BIN List API.
     * @param string $bin The Bank Identification Number to fetch data for.
     * @return array The decoded JSON response containing the BIN data, or an empty array if no data is found.
     */
    public function getBinDataForBin(string $bin): array;
}