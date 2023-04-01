<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver;

final class VATRateResolverError extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Can\'t find VAT rate for this TIN');
    }
}
