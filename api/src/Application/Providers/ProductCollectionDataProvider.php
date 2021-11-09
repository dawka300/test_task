<?php

namespace App\Application\Providers;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\DTO\Product;
use App\Application\Factory\ProductFactory;
use App\Domain\Product\ProductFacade;

class ProductCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private ProductFacade $productFacade)
    {
    }

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        $products = $this->productFacade->getAllProducts();

        foreach ($products as $product) {
            yield ProductFactory::createOutputFromDto($product);
        }
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Product::class === $resourceClass;
    }
}
