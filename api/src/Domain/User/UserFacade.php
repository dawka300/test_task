<?php

namespace App\Domain\User;

use App\Domain\User\DTO\RegisterUserDto;
use App\Domain\User\DTO\UserDto;
use App\Domain\User\Storage\UserStorageInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class UserFacade
{
    public function __construct(private UserStorageInterface $userStorage)
    {
    }

    public function getUser(UuidInterface $id): ?UserDto
    {
        return $this->userStorage->getUser($id);
    }

    public function getAllUsers(): ArrayCollection
    {
        return $this->userStorage->getAllUsers();
    }

    public function updateUser(UserDto $userDto): void
    {
        $this->userStorage->updateUser($userDto);
    }

    public function registerUser(RegisterUserDto $registerUserDto): string
    {
        return $this->userStorage->registerUser($registerUserDto);
    }
}
