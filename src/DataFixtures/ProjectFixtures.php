<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $project1 = new Project();
        $project1->setTitle("Projet 1");
        $project1->setCustomer($this->getReference('customer-1'));
        $project1->addCategory($this->getReference('category-php'));
        $project1->addCategory($this->getReference('category-wordpress'));
        $manager->persist($project1);

        $project2 = new Project();
        $project2->setTitle("Projet 2");
        $project2->setCustomer($this->getReference('customer-1'));
        $project2->addCategory($this->getReference('category-php'));
        $project2->addCategory($this->getReference('category-symfony'));
        $manager->persist($project2);

        $project3 = new Project();
        $project3->setTitle("Projet 3");
        $project3->setCustomer($this->getReference('customer-2'));
        $manager->persist($project3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class, CustomerFixtures::class];
    }
}
