<?php

namespace App\Infrastructure\Product\Factory;

use App\Domain\Product\DTO\ProductDto;
use App\Entity\Product;

class ProductFactory
{
    public static function createDtoFromEntity(Product $product): ProductDto
    {
        return new ProductDto(
            $product->getId(),
            $product->getName(),
            $product->getQuantity(),
            $product->getUnit()
        );
    }
}
