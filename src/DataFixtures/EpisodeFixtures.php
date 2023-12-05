<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;
use Faker\Factory;


class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        
        foreach (ProgramFixtures::PROGRAMS as $programName => $programDetails) {
            for($seasonIndex = 1; $seasonIndex <= 5; $seasonIndex++) {
                for($episodeIndex = 1; $episodeIndex <= 10; $episodeIndex++) {
                    $episode = new Episode();
                    $episode->setTitle($faker->paragraph(1));
                    $episode->setNumber($episodeIndex);
                    $episode->setSynopsis($faker->paragraph(1));
                    $episode->setSeason($this->getReference('season' . $seasonIndex . '_' . $programName));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
