<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;
use App\Entity\Actor;



class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Walking dead',
        'Stranger Things',
        'The Witcher',
        'Loki',
        'Bad Batch',
        'Arcane',
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
            for($actorIndex = 1; $actorIndex <= 10; $actorIndex++) {
                
                $actor = new Actor();
                $actor->setName($faker->name());
                $this->addReference('actor_' . $actorIndex, $actor);
                for ($programIndex = 1; $programIndex <= 3; $programIndex++) {
                    $actor->addProgram($this->getReference('program_' . self::PROGRAMS[rand(0,5)]));
                }
                $manager->persist($actor);
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
