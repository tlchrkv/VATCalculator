<?php

declare(strict_types=1);

namespace App\Exceptions;

final class InvalidTaxPercent extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Tax percent can\'t be less than 0 and more than 100');
    }
}
