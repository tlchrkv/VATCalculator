<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\VAT\VATRate;

final class VATRate
{
    public function __construct(private readonly int $value) {}

    public function getValue(): int
    {
        return $this->value;
    }
}
