<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Episode;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setTitle('Welcome to the Playground');
        $episode->setNumber(1);
        $episode->setSynopsis('premier episode ouai c\'est le début');
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('A l\'aventure lol');
        $episode->setNumber(2);
        $episode->setSynopsis('Attention on est au deuxième ahahhahahaha');
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          SeasonFixtures::class,
        ];
    }
}
