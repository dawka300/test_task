<?php

namespace App\Application\DTO;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @codeCoverageIgnore
 */
class RegisterUserOutput
{
    #[ApiProperty(identifier: true), Assert\Type('string'), Assert\NotBlank]
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
