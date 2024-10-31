<?php

namespace App\DataFixtures;

use App\Entity\Job;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Enum\JobStatus;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class JobFixtures extends Fixture implements DependentFixtureInterface
{
    public const REFERENCE_PREFIX = 'job_';
    public const MAX_DATA = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::MAX_DATA; $i++) {
            $job = new Job();
            $job->setTitle($faker->jobTitle());
            $job->setDescription($faker->sentence());

            $customerReference = $this->getReference(CustomerFixtures::REFERENCE_PREFIX . rand(1, CustomerFixtures::MAX_DATA));
            $job->setCustomer($customerReference);

            $manager->persist($job);

            $this->addReference(self::REFERENCE_PREFIX . $i, $job);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CustomerFixtures::class,
        ];
    }
}
