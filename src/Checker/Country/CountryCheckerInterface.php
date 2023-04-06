<?php

namespace App\Checker\Country;

interface CountryCheckerInterface
{
    /**
     * Checks whether the provided country code belongs to a country within the specified region.
     *
     * @param string|null $countryCode The 2-letter country code to check, or null if not available.
     * @return bool True if the country code belongs to a country in the specified region, false otherwise.
     */
    public function checkCountryCode(?string $countryCode): bool;
}