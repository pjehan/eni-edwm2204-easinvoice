<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $symfony = new Category();
        $symfony->setName('Symfony');
        $manager->persist($symfony);

        $php = new Category();
        $php->setName('PHP');
        $manager->persist($php);

        $wordpress = new Category();
        $wordpress->setName('WordPress');
        $manager->persist($wordpress);

        $manager->flush();
    }
}
