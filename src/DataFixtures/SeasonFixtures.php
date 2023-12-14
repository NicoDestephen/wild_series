<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Season;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        foreach (ProgramFixtures::PROGRAMS as $programName => $programDetails) {
        for($seasonIndex = 1; $seasonIndex <= 5; $seasonIndex++) {
            $season = new Season();
            $season->setNumber($seasonIndex);
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraph(1));
            $season->setProgram($this->getReference('program_' . $programName));
            $this->addReference('season' . $seasonIndex . '_' . $programName, $season);
            $manager->persist($season);
        }
    }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          ProgramFixtures::class,
        ];
    }
}
