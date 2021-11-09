<?php

namespace App\Tests\Api\Application\Factory;

use App\Application\DTO\User;
use App\Application\Factory\UserFactory;
use App\Domain\User\DTO\UserDto;
use App\Tests\UnitTest\TestCaseProphecy;
use Ramsey\Uuid\Uuid;

class UserFactoryTest extends TestCaseProphecy
{
    private UserDto $userDto;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $userId = Uuid::uuid4();
        $this->userDto = new UserDto(
           $userId, 'email@wp.pl', 'password', ['ROLE_CUSTOMER']
       );

        $this->user = (new User())->setId($userId)->setEmail('email@wp.pl')->setPassword('password')->setRoles(['ROLE_CUSTOMER']);
    }

    public function testCreateOutputFromDto()
    {
        $result = UserFactory::createOutputFromDto($this->userDto);
        $this->assertEquals($this->user, $result);
    }
}
