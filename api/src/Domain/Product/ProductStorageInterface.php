<?php

namespace App\Domain\Product;

use App\Domain\Product\DTO\ProductDto;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

interface ProductStorageInterface
{
    public function storeProduct(ProductDto $productDto): void;

    public function updateProduct(ProductDto $productDto): void;

    public function getProduct(UuidInterface $id): ?ProductDto;

    public function getAllProducts(): ArrayCollection;

    public function removeProduct(UuidInterface $id): void;
}
