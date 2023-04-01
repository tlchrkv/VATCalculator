<?php

declare(strict_types=1);

namespace App\Entity\Taxes;

use App\Entity\Shared\CountryCode;
use App\Repository\CountryTaxRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CountryTaxRepository::class)]
class CountryTax
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private readonly Uuid $id;
    #[ORM\Column(length: 2)]
    private readonly string $countryCode;
    #[ORM\Column]
    private readonly int $value;

    public function __construct(Uuid $id, CountryCode $countryCode, TaxPercent $value)
    {
        $this->id = $id;
        $this->countryCode = $countryCode->getValue();
        $this->value = $value->getValue();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getCountryCode(): CountryCode
    {
        return new CountryCode($this->countryCode);
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
