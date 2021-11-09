<?php

namespace App\Application\Persisters;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\DTO\Product;
use App\Application\Factory\ProductFactory;
use App\Domain\Product\ProductFacade;
use Ramsey\Uuid\Uuid;

class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private ProductFacade $productFacade)
    {
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Product;
    }

    public function persist($data, array $context = [])
    {
        $this->productFacade->updateProduct(
            ProductFactory::createDtoFromInput($data)
        );
    }

    public function remove($data, array $context = [])
    {
        $this->productFacade->removeProduct(Uuid::fromString($data->getProductId()));
    }
}
