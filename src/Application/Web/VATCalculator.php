<?php

declare(strict_types=1);

namespace App\Application\Web;

use App\Application\Web\Validator\TINConstraint\TINConstraint;
use App\Domain\Product\Product;
use App\Domain\VATRateResolver\TIN\TIN;
use App\Domain\VATRateResolver\VATRateResolver;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;

final class VATCalculator
{
    #[Assert\NotBlank]
    public Product $product;

    #[Assert\NotBlank]
    #[TINConstraint]
    public TIN $TIN;

    public function __construct(
        private readonly VATRateResolver $VATRateResolver,
    ) {}

    public function calculateVATInclusivePrice(): Money
    {
        $VATRate = $this->VATRateResolver->resolveVATRateByTIN($this->TIN);
        $VATAmount = $this->product->getPrice()->multiply($VATRate->getValue() / 100);

        return $this->product->getPrice()->add($VATAmount);
    }
}
