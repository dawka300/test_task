<?php

namespace App\Tests\Api\Domain\User;

use App\Domain\User\DTO\RegisterUserDto;
use App\Domain\User\DTO\UserDto;
use App\Domain\User\Storage\UserStorageInterface;
use App\Domain\User\UserFacade;
use App\Tests\UnitTest\TestCaseProphecy;
use Doctrine\Common\Collections\ArrayCollection;
use Prophecy\Prophecy\ObjectProphecy;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UserFacadeTest extends TestCaseProphecy
{
    private UserFacade $userFacade;

    private UserStorageInterface|ObjectProphecy $userStorageMock;

    private UuidInterface $uuid;

    private UserDto $userDto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->uuid = Uuid::uuid4();

        $this->userStorageMock = $this->prophesize(UserStorageInterface::class);

        $this->userFacade = new UserFacade($this->userStorageMock->reveal());

        $this->userDto = new UserDto(
            $this->uuid, 'email@examle.com', 'password', ['ROLE_ADMIN']
        );
    }

    public function testGetUser(): void
    {
        $this->userStorageMock
            ->getUser($this->uuid)
            ->willReturn($this->userDto)
            ->shouldBeCalledOnce();

        $this->userFacade->getUser($this->uuid);
    }

    public function testGetAllUsers(): void
    {
        $this->userStorageMock
            ->getAllUsers()
            ->willReturn(new ArrayCollection([$this->userDto]))
            ->shouldBeCalledOnce();

        $this->userFacade->getAllUsers();
    }

    public function testUpdateUser(): void
    {
        $this->userStorageMock
            ->updateUser($this->userDto)
            ->shouldBeCalledOnce();

        $this->userFacade->updateUser($this->userDto);
    }

    public function testRegisterUser(): void
    {
        $registerDto = new RegisterUserDto('email@wp.pl', 'password');

        $this->userStorageMock
            ->registerUser($registerDto)
            ->willReturn($this->uuid->toString())
            ->shouldBeCalledOnce();

        $this->userFacade->registerUser($registerDto);
    }
}
