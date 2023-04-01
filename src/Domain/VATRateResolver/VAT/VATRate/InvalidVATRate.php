<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\VAT\VATRate;

final class InvalidVATRate extends \DomainException
{
    public function __construct()
    {
        parent::__construct('VAT rate can\'t be less than 0 and more than 100');
    }
}
