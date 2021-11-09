<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * @codeCoverageIgnore
 */
class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->users() as $user) {
            $userToStore = new User();
            $userToStore->setEmail($user['email']);
            $hashPassword = $this->userPasswordHasher->hashPassword($userToStore, $user['password']);
            $userToStore->setPassword($hashPassword);
            $userToStore->setRoles($user['role']);

            $manager->persist($userToStore);
        }

        $manager->flush();
    }

    private function users(): array
    {
        return [
              ['email' => 'admin@example.com', 'password' => 'admin', 'role' => ['ROLE_ADMIN']],
              ['email' => 'customer1@example.com', 'password' => 'customer1', 'role' => ['ROLE_CUSTOMER']],
              ['email' => 'customer2@example.com', 'password' => 'customer2', 'role' => ['ROLE_CUSTOMER']],
              ['email' => 'retailer1@example.com', 'password' => 'retailer1', 'role' => ['ROLE_RETAILER']],
              ['email' => 'retailer2@example.com', 'password' => 'retailer2', 'role' => ['ROLE_RETAILER']],
          ];
    }
}
