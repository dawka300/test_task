<?php

namespace App\Application\Providers;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\DTO\User;
use App\Application\Factory\UserFactory;
use App\Domain\User\UserFacade;

class UserCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private UserFacade $userFacade)
    {
    }

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        $users = $this->userFacade->getAllUsers();

        foreach ($users as $user) {
            yield UserFactory::createOutputFromDto($user);
        }
    }

    /**
     * @codeCoverageIgnore
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return User::class === $resourceClass;
    }
}
