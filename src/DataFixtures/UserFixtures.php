<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    /**
     * Create admin account
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {

        $admin = new user();
        $hashedPassword = $this->passwordHasher->hashPassword($admin, "password");

        $admin->setEmail('francois.coche@outlook.it')
                ->setRoles(['ROLE_ADMIN'])
                ->setPassword($hashedPassword);

        $manager->persist($admin);
        $manager->flush();
    }
}
