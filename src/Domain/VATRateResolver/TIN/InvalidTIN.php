<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\TIN;

final class InvalidTIN extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Invalid TIN');
    }
}
