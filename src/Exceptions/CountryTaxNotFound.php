<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Entity\Shared\CountryCode;

final class CountryTaxNotFound extends \DomainException
{
    public function __construct(CountryCode $countryCode)
    {
        parent::__construct(sprintf('Taxes not found for country %s', $countryCode->getValue()));
    }
}
