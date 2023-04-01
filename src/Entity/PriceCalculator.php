<?php

declare(strict_types=1);

namespace App\Entity;

use App\Entity\Taxes\CustomerTaxNumber;
use App\Repository\CountryTaxRepository;
use Money\Money;
use Symfony\Component\Validator\Constraints as Assert;

final class PriceCalculator
{
    #[Assert\NotBlank]
    public Product $product;

    #[Assert\NotBlank]
    public CustomerTaxNumber $taxNumber;

    public function __construct(
        private readonly CountryTaxRepository $countryTaxRepository,
    ) {}

    public function calculatePriceWithCountryTax(): Money
    {
        $countryTax = $this->countryTaxRepository->findOneByCountryCode($this->taxNumber->extractCountryCode());
        $taxAmount = $this->product->getPrice()->multiply($countryTax->getValue() / 100);

        return $this->product->getPrice()->add($taxAmount);
    }
}
