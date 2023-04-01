<?php

declare(strict_types=1);

namespace App\Domain\Product;

use Doctrine\ORM\Mapping as ORM;
use Money\Currency;
use Money\Money;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    private readonly Uuid $id;
    #[ORM\Column(length: 255)]
    private readonly string $name;
    #[ORM\Column]
    private readonly int $price;
    #[ORM\Column(length: 3)]
    private readonly string $currency;

    public function __construct(Uuid $id, string $name, Money $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = (int) $price->getAmount();
        $this->currency = $price->getCurrency()->getCode();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): Money
    {
        return new Money($this->price, new Currency($this->currency));
    }
}
