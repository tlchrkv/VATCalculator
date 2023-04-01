<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\CountryCode;

final class InvalidCountryCode extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Country code must must be compatibility with ISO 3166-1 format');
    }
}
