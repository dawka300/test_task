<?php

namespace App\Infrastructure\User\Factory;

use App\Domain\User\DTO\UserDto;
use App\Entity\User;

class UserFactory
{
    public static function createDtoFromEntity(User $user): UserDto
    {
        return new UserDto(
            $user->getId(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getRoles()
        );
    }
}
