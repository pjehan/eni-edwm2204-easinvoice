<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $customer1 = new Customer();
        $customer1->setName('Client 1');
        $manager->persist($customer1);
        $this->addReference('customer-1', $customer1);

        $customer2 = new Customer();
        $customer2->setName('Client 2');
        $manager->persist($customer2);
        $this->addReference('customer-2', $customer2);

        $customer3 = new Customer();
        $customer3->setName('Client 3');
        $manager->persist($customer3);
        $this->addReference('customer-3', $customer3);

        $manager->flush();
    }
}
