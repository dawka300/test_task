<?php

namespace App\Domain\Product\DTO;

class ProductDto
{
    public function __construct(
        private ?string $productId,
        private string $name,
        private float $quantity,
        private string $unit
) {
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }
}
