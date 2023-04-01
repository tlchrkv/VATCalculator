<?php

namespace App\Form\DataTransformer;

use App\Entity\Taxes\CustomerTaxNumber;
use App\Exceptions\InvalidCustomerTaxNumber;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

final class TaxNumberTransformer implements DataTransformerInterface
{
    public function transform($taxNumber): string
    {
        if (!$taxNumber instanceof CustomerTaxNumber) {
            return '';
        }

        return $taxNumber->getFullNumber();
    }

    public function reverseTransform($taxNumber): CustomerTaxNumber
    {
        try {
            return new CustomerTaxNumber($taxNumber);
        } catch (InvalidCustomerTaxNumber $e) {
            throw new TransformationFailedException($e->getMessage());
        }
    }
}
