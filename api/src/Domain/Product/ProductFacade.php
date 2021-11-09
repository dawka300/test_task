<?php

namespace App\Domain\Product;

use App\Domain\Product\DTO\ProductDto;
use App\Infrastructure\Product\ProductStorage;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class ProductFacade
{
    public function __construct(private ProductStorage $productStorage)
    {
    }

    public function getProduct(UuidInterface $id): ?ProductDto
    {
        return $this->productStorage->getProduct($id);
    }

    public function getAllProducts(): ArrayCollection
    {
        return $this->productStorage->getAllProducts();
    }

    public function removeProduct(UuidInterface $id): void
    {
        $this->productStorage->removeProduct($id);
    }

    public function updateProduct(ProductDto $productDto): void
    {
        $this->productStorage->updateProduct($productDto);
    }

    public function storeProduct(ProductDto $productDto): void
    {
        $this->productStorage->storeProduct($productDto);
    }
}
