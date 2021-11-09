<?php

namespace App\Application\Persisters;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\DTO\User;
use App\Domain\User\DTO\UserDto;
use App\Domain\User\UserFacade;

class UserDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private UserFacade $userFacade)
    {
    }

    /**
     * @codeCoverageIgnore
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User;
    }

    /** @param User $data */
    public function persist($data, array $context = [])
    {
        $this->userFacade->updateUser(new UserDto(
           $data->getId(), $data->getEmail(), $data->getPassword(), $data->getRoles()
       ));
    }

    /**
     * @codeCoverageIgnore
     */
    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}
