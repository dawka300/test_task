<?php

namespace App\Application\DTO;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @codeCoverageIgnore
 */
#[ApiResource]
class User
{
    public const READ = 'data:read';
    public const UPDATE = 'data:update';

    #[ApiProperty(identifier: true), Assert\NotBlank, Groups([User::READ])]
    private string $id;

    #[ApiProperty, Assert\Email, Assert\NotBlank, Groups([User::READ, User::UPDATE])]
    private string $email;

    #[ApiProperty, Assert\Type('string'), Assert\NotBlank, Groups([User::UPDATE])]
    private string $password;

    #[ApiProperty, Assert\Type('array'), Groups([User::READ, User::UPDATE])]
    private array $roles;

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
}
