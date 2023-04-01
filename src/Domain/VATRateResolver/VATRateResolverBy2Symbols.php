<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver;

use App\Domain\VATRateResolver\CountryCode\CountryCode;
use App\Domain\VATRateResolver\TIN\InvalidTIN;
use App\Domain\VATRateResolver\TIN\TIN;
use App\Domain\VATRateResolver\TIN\TINValidator;
use App\Domain\VATRateResolver\VAT\VATRate\VATRate;
use App\Domain\VATRateResolver\VAT\VATRepository;

final class VATRateResolverBy2Symbols implements VATRateResolver
{
    public function __construct(
        private readonly TINValidator $TINValidator,
        private readonly VATRepository $VATRepository
    ) {}

    /**
     * @throws InvalidTIN|VATRateResolverError
     */
    public function resolveVATRateByTIN(TIN $TIN): VATRate
    {
        if (!$this->TINValidator->isValid($TIN)) {
            throw new InvalidTIN();
        }

        $VAT = $this->VATRepository->findOneByCountryCode($this->extractTINCountryCode($TIN));

        if ($VAT === null) {
            throw new VATRateResolverError();
        }

        return $VAT->getRate();
    }

    public function extractTINCountryCode(TIN $TIN): CountryCode
    {
        return new CountryCode(mb_substr($TIN->getValue(), 0, 2));
    }
}
