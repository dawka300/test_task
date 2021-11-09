<?php

namespace App\Application\Controllers;

use App\Application\DTO\RegisterUserInput;
use App\Application\DTO\RegisterUserOutput;
use App\Domain\User\DTO\RegisterUserDto;
use App\Domain\User\UserFacade;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationController
{
    public function __invoke(
        RegisterUserInput $data,
        ValidatorInterface $validator,
        UserFacade $userFacade,
    ): RegisterUserOutput {
        $validator->validate($data);

        $token = $userFacade->registerUser(new RegisterUserDto(
            $data->getEmail(), $data->getPassword()
        ));

        return new RegisterUserOutput($token);
    }
}
