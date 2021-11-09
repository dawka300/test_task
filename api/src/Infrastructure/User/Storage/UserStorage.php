<?php

namespace App\Infrastructure\User\Storage;

use App\Domain\User\DTO\RegisterUserDto;
use App\Domain\User\DTO\UserDto;
use App\Domain\User\Storage\UserStorageInterface;
use App\Entity\User;
use App\Infrastructure\User\Factory\UserFactory;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserStorage implements UserStorageInterface
{
    public function __construct(
        private UserRepository $userRepository,
        private EntityManagerInterface $entityManager,
        private JWTTokenManagerInterface $JWTManager,
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function getAllUsers(): ArrayCollection
    {
        $users = $this->userRepository->findAll();
        $result = new ArrayCollection();

        foreach ($users as $user) {
            $result->add(UserFactory::createDtoFromEntity($user));
        }

        return $result;
    }

    public function registerUser(RegisterUserDto $registerUserDto): string
    {
        $newUser = new User();
        $newUser->setEmail($registerUserDto->getEmail())
            ->setPassword(
                $this->userPasswordHasher->hashPassword($newUser, $registerUserDto->getPassword())
            );

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        return $this->JWTManager->create($newUser);
    }

    public function updateUser(UserDto $userDto): void
    {
        $user = $this->userRepository->findOneBy(['id' => $userDto->getUserId()]);
        $user->setEmail($userDto->getEmail())
            ->setPassword(
                $this->userPasswordHasher->hashPassword($user, $user->getPassword())
            )
            ->setRoles($userDto->getRoles());

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function getUser(UuidInterface $id): ?UserDto
    {
        $user = $this->userRepository->find($id);

        if (null === $user) {
            return null;
        }

        return UserFactory::createDtoFromEntity($user);
    }
}
