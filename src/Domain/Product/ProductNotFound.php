<?php

declare(strict_types=1);

namespace App\Domain\Product;

use Symfony\Component\Uid\Uuid;

final class ProductNotFound extends \DomainException
{
    public function __construct(Uuid $productId)
    {
        parent::__construct(sprintf('Product with id %s not found', $productId));
    }
}
