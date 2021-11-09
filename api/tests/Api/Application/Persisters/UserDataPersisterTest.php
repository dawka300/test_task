<?php

namespace App\Tests\Api\Application\Persisters;

use App\Application\DTO\User;
use App\Application\Persisters\UserDataPersister;
use App\Domain\User\DTO\UserDto;
use App\Domain\User\UserFacade;
use App\Tests\UnitTest\TestCaseProphecy;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Ramsey\Uuid\Uuid;

class UserDataPersisterTest extends TestCaseProphecy
{
    private UserDataPersister $userDataPersister;

    private UserFacade|ObjectProphecy $userFacadeMock;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userFacadeMock = $this->prophesize(UserFacade::class);

        $this->userDataPersister = new UserDataPersister($this->userFacadeMock->reveal());

        $userId = Uuid::uuid4();

        $this->user = (new User())->setId($userId)->setEmail('email@wp.pl')->setPassword('password')->setRoles(['ROLE_CUSTOMER']);
    }

    public function testPersist(): void
    {
        $this->userFacadeMock
            ->updateUser(Argument::type(UserDto::class))
            ->shouldBeCalledOnce();

        $this->userDataPersister->persist($this->user);
    }
}
