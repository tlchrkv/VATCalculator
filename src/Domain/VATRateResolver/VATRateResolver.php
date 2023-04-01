<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver;

use App\Domain\VATRateResolver\TIN\InvalidTIN;
use App\Domain\VATRateResolver\TIN\TIN;
use App\Domain\VATRateResolver\VAT\VATRate\VATRate;

interface VATRateResolver
{
    /**
     * @throws InvalidTIN|VATRateResolverError
     */
    public function resolveVATRateByTIN(TIN $TIN): VATRate;
}
