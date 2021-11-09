<?php

namespace App\Application\Factory;

use App\Application\DTO\User;
use App\Domain\User\DTO\UserDto;

class UserFactory
{
    public static function createOutputFromDto(UserDto $userDto): User
    {
        return (new User())
            ->setId($userDto->getUserId())
            ->setEmail($userDto->getEmail())
            ->setPassword($userDto->getPassword())
            ->setRoles($userDto->getRoles());
    }
}
