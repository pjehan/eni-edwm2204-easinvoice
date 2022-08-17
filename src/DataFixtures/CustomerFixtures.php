<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $customer1 = new Customer();
        $customer1->setName('Client 1');
        $customer1->setUser($this->getReference('user-admin'));
        $manager->persist($customer1);
        $this->addReference('customer-1', $customer1);

        $customer2 = new Customer();
        $customer2->setName('Client 2');
        $customer2->setUser($this->getReference('user-admin'));
        $manager->persist($customer2);
        $this->addReference('customer-2', $customer2);

        $customer3 = new Customer();
        $customer3->setName('Client 3');
        $customer3->setUser($this->getReference('user-john'));
        $manager->persist($customer3);
        $this->addReference('customer-3', $customer3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
