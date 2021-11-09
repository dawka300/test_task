<?php

namespace App\Tests\Api\Application\Providers;

use App\Application\DTO\User;
use App\Application\Providers\UserItemDataProvider;
use App\Domain\User\DTO\UserDto;
use App\Domain\User\UserFacade;
use App\Tests\UnitTest\TestCaseProphecy;
use Prophecy\Prophecy\ObjectProphecy;
use Ramsey\Uuid\Uuid;

class UserItemDataProviderTest extends TestCaseProphecy
{
    private UserItemDataProvider $userItemDataProvider;

    private UserFacade|ObjectProphecy $userFacadeMock;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userFacadeMock = $this->prophesize(UserFacade::class);

        $this->userItemDataProvider = new UserItemDataProvider($this->userFacadeMock->reveal());

        $userId = Uuid::uuid4();

        $this->user = (new User())->setId($userId->toString())->setEmail('email@wp.pl')->setPassword('password')->setRoles(['ROLE_CUSTOMER']);
    }

    public function testGetItem(): void
    {
        $this->userFacadeMock
            ->getUser(Uuid::fromString($this->user->getId()))
            ->willReturn(new UserDto($this->user->getId(), $this->user->getEmail(), $this->user->getPassword(), ['ROLE_ADMIN']))
            ->shouldBeCalledOnce();

        $this->userItemDataProvider->getItem(User::class, $this->user->getId());
    }
}
