<?php

namespace App\Application\Web\Form\TINType;

use App\Domain\VATRateResolver\TIN\TIN;
use Symfony\Component\Form\DataTransformerInterface;

final class TINTransformer implements DataTransformerInterface
{
    public function transform($TIN): string
    {
        if (!$TIN instanceof TIN) {
            return '';
        }

        return $TIN->getValue();
    }

    public function reverseTransform($value): TIN
    {
        return new TIN($value);
    }
}
