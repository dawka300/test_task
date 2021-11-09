<?php

namespace App\Application\Factory;

use App\Application\DTO\Product;
use App\Domain\Product\DTO\ProductDto;

class ProductFactory
{
    public static function createOutputFromDto(ProductDto $productDto): Product
    {
        return new Product(
            $productDto->getProductId(),
            $productDto->getName(),
            $productDto->getQuantity(),
            $productDto->getUnit()
        );
    }

    public static function createDtoFromInput(Product $product): ProductDto
    {
        return new ProductDto(
            $product->getProductId(),
            $product->getName(),
            $product->getQuantity(),
            $product->getUnit()
        );
    }
}
