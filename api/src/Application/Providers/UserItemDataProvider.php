<?php

namespace App\Application\Providers;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\DTO\User;
use App\Application\Factory\UserFactory;
use App\Domain\User\UserFacade;
use Ramsey\Uuid\Uuid;

class UserItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private UserFacade $userFacade)
    {
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): User|null
    {
        $user = $this->userFacade->getUser(Uuid::fromString($id));

        return UserFactory::createOutputFromDto($user);
    }

    /**
     * @codeCoverageIgnore
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return User::class === $resourceClass;
    }
}
