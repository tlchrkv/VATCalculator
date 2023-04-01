<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\TIN;

final class TIN
{
    public function __construct(private readonly string $value) {}

    public function getValue(): string
    {
        return $this->value;
    }
}
