<?php

declare(strict_types=1);

namespace App\Application\Web\Validator\TINConstraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
final class TINConstraint extends Constraint
{
    public string $message = 'TIN is not valid';
    public string $mode = 'strict';
}
