<?php

namespace App\Application\DTO;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @codeCoverageIgnore
 */
class Product
{
    public const READ = 'data:read';
    public const UPDATE = 'data:update';

    #[ApiProperty, Groups([self::READ])]
    private ?string $productId;

    #[ApiProperty(identifier: true), Assert\Type('string'), Assert\NotBlank, Groups([self::READ, self::UPDATE])]
    private string $name;

    #[ApiProperty, Assert\Type('float'), Groups([self::READ, self::UPDATE])]
    private float $quantity;

    #[ApiProperty, Assert\Type('string'), Groups([self::READ, self::UPDATE])]
    private string $unit;

    public function __construct(?string $productId = null, string $name, float $quantity, string $unit = 'kilogram')
    {
        $this->productId = $productId;
        $this->name = $name;
        $this->quantity = $quantity;
        $this->unit = $unit;
    }

    public function getProductId(): ?string
    {
        return $this->productId;
    }

    public function setProductId(?string $productId): void
    {
        $this->productId = $productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getUnit(): string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }
}
