<?php

namespace App\Application\Providers;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\DTO\Product;
use App\Application\Factory\ProductFactory;
use App\Domain\Product\ProductFacade;
use Ramsey\Uuid\Uuid;

class ProductItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private ProductFacade $productFacade)
    {
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): Product
    {
        return ProductFactory::createOutputFromDto(
            $this->productFacade->getProduct(Uuid::fromString($id))
        );
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Product::class === $resourceClass;
    }
}
