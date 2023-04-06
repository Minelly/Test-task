<?php

namespace App\Handler;

interface BinLookupInterface
{
    /**
     * Retrieves the 2-letter country code associated with the given Bank Identification Number (BIN).
     * @param string $bin The Bank Identification Number to look up.
     * @return string|null The 2-letter country code if found, or null if not available.
     */
    public function getCountryCode(string $bin): ?string;
}