<?php

declare(strict_types=1);

namespace App\Exceptions;

final class InvalidCustomerTaxNumber extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Invalid customer tax number');
    }
}
