<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\CountryCode;

final class CountryCodeValidator
{
    public function isValid(CountryCode $countryCode): bool
    {
        return strlen($countryCode->getValue()) === 2;
    }
}
