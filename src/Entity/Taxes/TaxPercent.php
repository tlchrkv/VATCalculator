<?php

declare(strict_types=1);

namespace App\Entity\Taxes;

use App\Exceptions\InvalidTaxPercent;

final class TaxPercent
{
    private readonly int $value;

    public function __construct(int $value)
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidTaxPercent();
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
