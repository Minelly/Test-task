<?php

namespace App\Checker\Country;


use App\Enum\Country\EuCountryEnum;

class EuCountryChecker implements CountryCheckerInterface
{
    /**
     * @inheritDoc
     */
    public function checkCountryCode(?string $countryCode): bool
    {
        return $countryCode !== null && EuCountryEnum::tryFrom($countryCode) !== null;
    }
}