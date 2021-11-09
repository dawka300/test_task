<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $ProductId;

    #[ORM\Column(type: 'string', length: 255)]
    private $UserId;

    #[ORM\Column(type: 'float')]
    private float $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?string
    {
        return $this->ProductId;
    }

    public function setProductId(string $ProductId): self
    {
        $this->ProductId = $ProductId;

        return $this;
    }

    public function getUserId(): ?string
    {
        return $this->UserId;
    }

    public function setUserId(string $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
