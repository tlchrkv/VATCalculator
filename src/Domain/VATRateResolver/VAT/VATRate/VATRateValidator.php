<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\VAT\VATRate;

final class VATRateValidator
{
    public function isValid(VATRate $VATRate): bool
    {
        return $VATRate->getValue() > 0 && $VATRate->getValue() < 100;
    }
}
