<?php

namespace App\Domain\User\DTO;

class UserDto
{
    public function __construct(
        private string $userId,
        private string $email,
        private string $password,
        private array $roles
    ) {
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
