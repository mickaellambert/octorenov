<?php

namespace App\DataFixtures;

use App\Entity\Jobber;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class JobberFixtures extends Fixture
{
    public const REFERENCE_PREFIX = 'jobber_';
    public const MAX_DATA = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= self::MAX_DATA; $i++) {
            $jobber = new Jobber();
            $jobber->setName($faker->company());
            $jobber->setEmail($faker->unique()->email());
            $manager->persist($jobber);

            $this->addReference(self::REFERENCE_PREFIX . $i, $jobber);
        }

        $manager->flush();
    }
}
