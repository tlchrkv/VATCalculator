<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\VAT;

use App\Domain\VATRateResolver\CountryCode\CountryCode;
use App\Domain\VATRateResolver\CountryCode\CountryCodeValidator;
use App\Domain\VATRateResolver\CountryCode\InvalidCountryCode;
use App\Domain\VATRateResolver\VAT\VATRate\InvalidVATRate;
use App\Domain\VATRateResolver\VAT\VATRate\VATRate;
use App\Domain\VATRateResolver\VAT\VATRate\VATRateValidator;
use Symfony\Component\Uid\Uuid;

final class AddVATService
{
    public function __construct(
        private readonly VATRepository $VATRepository,
        private readonly CountryCodeValidator $countryCodeValidator,
        private readonly VATRateValidator $VATRateValidator
    ) {}

    public function __invoke(Uuid $id, CountryCode $countryCode, VATRate $VATRate): void
    {
        if (!$this->countryCodeValidator->isValid($countryCode)) {
            throw new InvalidCountryCode();
        }

        if (!$this->VATRateValidator->isValid($VATRate)) {
            throw new InvalidVATRate();
        }

        $this->VATRepository->save(new VAT($id, $countryCode, $VATRate), flush: true);
    }
}
