<?php

namespace App\Tests\Api\Application\Providers;

use App\Application\DTO\User;
use App\Application\Providers\UserCollectionDataProvider;
use App\Domain\User\UserFacade;
use App\Tests\UnitTest\TestCaseProphecy;
use Doctrine\Common\Collections\ArrayCollection;
use Prophecy\Prophecy\ObjectProphecy;
use Ramsey\Uuid\Uuid;

class UserCollectionDataProviderTest extends TestCaseProphecy
{
    private UserCollectionDataProvider $userCollectionDataProvider;

    private UserFacade|ObjectProphecy $userFacadeMock;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userFacadeMock = $this->prophesize(UserFacade::class);

        $this->userCollectionDataProvider = new UserCollectionDataProvider($this->userFacadeMock->reveal());

        $userId = Uuid::uuid4();

        $this->user = (new User())->setId($userId)->setEmail('email@wp.pl')->setPassword('password')->setRoles(['ROLE_CUSTOMER']);
    }

    public function testGetCollection(): void
    {
        /*$this->userFacadeMock
            ->getAllUsers()
            ->willReturn(new ArrayCollection([$this->user]))
             ->shouldBeCalledOnce();*/

        $result = $this->userCollectionDataProvider->getCollection(User::class, '');

        $this->assertInstanceOf(\Generator::class, $result);
    }
}
