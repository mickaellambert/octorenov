<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CustomerFixtures extends Fixture
{
    public const REFERENCE_PREFIX = 'customer_';
    public const MAX_DATA = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= self::MAX_DATA; $i++) {
            $customer = new Customer();
            $customer->setName(name: $faker->name());
            $customer->setEmail($faker->unique()->email());
            $manager->persist($customer);

            $this->addReference(self::REFERENCE_PREFIX . $i, $customer);
        }

        $manager->flush();
    }
}
