<?php

namespace App\Application\DTO;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @codeCoverageIgnore
 */
class RegisterUserInput
{
    #[ApiProperty(identifier: true), Assert\Type('email'), Assert\NotBlank]
    private string $email;

    #[ApiProperty, Assert\Type('string'), Assert\NotBlank]
    private string $password;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
