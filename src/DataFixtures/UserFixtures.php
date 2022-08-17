<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->hasher->hashPassword($admin, 'admin'));
        $manager->persist($admin);
        $this->addReference('user-admin', $admin);

        $john = new User();
        $john->setEmail('john@doe.fr');
        $john->setPassword($this->hasher->hashPassword($john, 'johndoe'));
        $manager->persist($john);
        $this->addReference('user-john', $john);

        $manager->flush();
    }
}
