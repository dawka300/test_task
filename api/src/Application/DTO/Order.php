<?php

namespace App\Application\DTO;

use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

class Order
{
    public const READ = 'data:read';
    public const UPDATE = 'data:update';

    #[ApiProperty(identifier: true), Assert\Type('string'), Groups([self::READ])]
    private string $orderId;
}
