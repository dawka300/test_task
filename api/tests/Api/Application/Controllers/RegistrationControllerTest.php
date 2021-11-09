<?php

namespace App\Tests\Api\Application\Controllers;

use App\Application\Controllers\RegistrationController;
use App\Application\DTO\RegisterUserInput;
use App\Domain\User\DTO\RegisterUserDto;
use App\Domain\User\UserFacade;
use App\Tests\UnitTest\TestCaseProphecy;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationControllerTest extends TestCaseProphecy
{
    private RegistrationController $registrationController;

    private ValidatorInterface|ObjectProphecy $validatorMock;

    private UserFacade|ObjectProphecy $userFacadeMock;

    private JWTTokenManagerInterface|ObjectProphecy $JWTManagerMock;

    private RegisterUserInput $registerUserInput;

    protected function setUp(): void
    {
        parent::setUp();
        $this->validatorMock = $this->prophesize(ValidatorInterface::class);
        $this->userFacadeMock = $this->prophesize(UserFacade::class);
        $this->JWTManagerMock = $this->prophesize(JWTTokenManagerInterface::class);
        $this->registrationController = new RegistrationController();
        $this->registerUserInput = new RegisterUserInput();
        $this->registerUserInput->setEmail('email@wp.pl');
        $this->registerUserInput->setPassword('password');
    }

    public function testInvoke(): void
    {
        $this->validatorMock
            ->validate($this->registerUserInput)
            ->shouldBeCalledOnce();

        $this->userFacadeMock
            ->registerUser(Argument::type(RegisterUserDto::class))
            ->willReturn('token')
            ->shouldBeCalledOnce();

        ($this->registrationController)(
            $this->registerUserInput,
            $this->validatorMock->reveal(),
            $this->userFacadeMock->reveal()
        );
    }
}
