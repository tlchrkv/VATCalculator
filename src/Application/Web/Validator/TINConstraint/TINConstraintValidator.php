<?php

declare(strict_types=1);

namespace App\Application\Web\Validator\TINConstraint;

use App\Application\Web\Validator\TINConstraint\TINConstraint as TINConstraint;
use App\Domain\VATRateResolver\TIN\TIN;
use App\Domain\VATRateResolver\TIN\TINValidator as TINDomainValidator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

final class TINConstraintValidator extends ConstraintValidator
{
    public function __construct(
        private readonly TINDomainValidator $TINDomainValidator,
    ) {}

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof TINConstraint) {
            throw new UnexpectedTypeException($constraint, TINConstraint::class);
        }

        if (null === $value) {
            return;
        }

        if (!$value instanceof TIN) {
            throw new UnexpectedValueException($value, TIN::class);
        }

        if (!$this->TINDomainValidator->isValid($value)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
