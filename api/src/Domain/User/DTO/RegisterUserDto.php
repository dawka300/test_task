<?php

namespace App\Domain\User\DTO;

/**
 * @codeCoverageIgnore
 */
class RegisterUserDto
{
    public function __construct(
       private string $email,
       private string $password
   ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
