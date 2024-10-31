<?php

namespace App\DataFixtures;

use App\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Enum\OfferStatus;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public const MAX_DATA = 5;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::MAX_DATA; $i++) {
            $offer = new Offer();
            $offer->setAmount($faker->randomFloat(2, 50, 500));

            $jobReference = $this->getReference(JobFixtures::REFERENCE_PREFIX . rand(0, JobFixtures::MAX_DATA - 1));
            $jobberReference = $this->getReference(JobberFixtures::REFERENCE_PREFIX . rand(1, JobberFixtures::MAX_DATA));

            $offer->setJob($jobReference);
            $offer->setJobber($jobberReference);

            $manager->persist($offer);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            JobberFixtures::class,
            JobFixtures::class,
        ];
    }
}
