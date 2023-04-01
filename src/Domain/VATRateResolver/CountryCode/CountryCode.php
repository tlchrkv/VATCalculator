<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\CountryCode;

/**
 * ISO 3166-1
 */
final class CountryCode
{
    private readonly string $value;

    public function __construct(string $value)
    {
        $this->value = strtoupper($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
