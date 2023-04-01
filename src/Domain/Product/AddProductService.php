<?php

declare(strict_types=1);

namespace App\Domain\Product;

use Money\Money;
use Symfony\Component\Uid\Uuid;

final class AddProductService
{
    public function __construct(private readonly ProductRepository $productRepository) {}

    public function __invoke(Uuid $id, string $name, Money $price): void
    {
        $this->productRepository->save(new Product($id, $name, $price), flush: true);
    }
}
