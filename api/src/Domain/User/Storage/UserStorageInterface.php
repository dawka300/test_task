<?php

namespace App\Domain\User\Storage;

use App\Domain\User\DTO\RegisterUserDto;
use App\Domain\User\DTO\UserDto;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

interface UserStorageInterface
{
    public function getUser(UuidInterface $id): ?UserDto;

    public function getAllUsers(): ArrayCollection;

    public function updateUser(UserDto $userDto): void;

    public function registerUser(RegisterUserDto $registerUserDto): string;
}
