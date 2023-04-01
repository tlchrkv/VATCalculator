<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\TIN;

final class TINValidator
{
    public function isValid(TIN $TIN): bool
    {
        return preg_match('/^[a-zA-Z]{2}[0-9]{9,12}$/', $TIN->getValue()) === 1;
    }
}
