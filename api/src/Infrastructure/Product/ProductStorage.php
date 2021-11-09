<?php

namespace App\Infrastructure\Product;

use App\Domain\Product\DTO\ProductDto;
use App\Domain\Product\ProductStorageInterface;
use App\Entity\Product;
use App\Infrastructure\Product\Factory\ProductFactory;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class ProductStorage implements ProductStorageInterface
{
    public function __construct(
        private ProductRepository $productRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function storeProduct(ProductDto $productDto): void
    {
        $newProduct = (new Product())
            ->setName($productDto->getName())
            ->setQuantity($productDto->getQuantity())
            ->setUnit($productDto->getUnit());

        $this->entityManager->persist($newProduct);
        $this->entityManager->flush();
    }

    public function getProduct(UuidInterface $id): ?ProductDto
    {
        return ProductFactory::createDtoFromEntity(
            $this->productRepository->find($id)
        );
    }

    public function getAllProducts(): ArrayCollection
    {
        $products = $this->productRepository->findAll();
        $result = new ArrayCollection();

        foreach ($products as $product) {
            $result->add(ProductFactory::createDtoFromEntity($product));
        }

        return $result;
    }

    public function removeProduct(UuidInterface $id): void
    {
        $product = $this->productRepository->find($id);
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }

    public function updateProduct(ProductDto $productDto): void
    {
        $product = $productDto->getProductId() ?
            $this->productRepository->find($productDto->getProductId()) :
            new Product();
        $product
            ->setName($productDto->getName())
            ->setQuantity($productDto->getQuantity())
            ->setUnit($productDto->getUnit());

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}
