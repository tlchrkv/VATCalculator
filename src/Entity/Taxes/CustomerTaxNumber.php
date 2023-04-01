<?php

declare(strict_types=1);

namespace App\Entity\Taxes;

use App\Entity\Shared\CountryCode;
use App\Exceptions\InvalidCustomerTaxNumber;

final class CustomerTaxNumber
{
    private readonly string $fullNumber;

    public function __construct(string $fullNumber)
    {
        if (preg_match('/^[a-zA-Z]{2}[0-9]{9,12}$/', $fullNumber) !== 1) {
            throw new InvalidCustomerTaxNumber();
        }

        $this->fullNumber = $fullNumber;
    }

    public function getFullNumber(): string
    {
        return $this->fullNumber;
    }

    public function extractCountryCode(): CountryCode
    {
        return new CountryCode(mb_substr($this->fullNumber, 0, 2));
    }
}
