<?php

declare(strict_types=1);

namespace App\Domain\VATRateResolver\VAT;

use App\Domain\VATRateResolver\CountryCode\CountryCode;
use App\Domain\VATRateResolver\VAT\VATRate\VATRate;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: VATRepository::class)]
class VAT
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private readonly Uuid $id;
    #[ORM\Column(length: 2)]
    private readonly string $countryCode;
    #[ORM\Column]
    private readonly int $rate;

    public function __construct(Uuid $id, CountryCode $countryCode, VATRate $rate)
    {
        $this->id = $id;
        $this->countryCode = $countryCode->getValue();
        $this->rate = $rate->getValue();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCountryCode(): CountryCode
    {
        return new CountryCode($this->countryCode);
    }

    public function getRate(): VATRate
    {
        return new VATRate($this->rate);
    }
}
