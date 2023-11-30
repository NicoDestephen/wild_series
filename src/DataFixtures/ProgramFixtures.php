<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Program1' => [
                        'title'    => 'Walking dead',
                        'synopsis' => 'Des zombies envahissent la terre',
                        'category' => 'Action',
                        'poster'   => '/build/images/walking_dead_poster.jpg',],
        'Program2' => [
                        'title'    => 'Stranger Things',
                        'synopsis' => 'Des enfants qui vont dans un monde parallèle',
                        'category' => 'Horreur',
                        'poster'   => '/build/images/stranger_things_poster.jpg',],
        'Program3' => [
                        'title'    => 'The Witcher',
                        'synopsis' => 'Un sorceleur qui tape des monstres',
                        'category' => 'Horreur',
                        'poster'   => '/build/images/the_witcher_poster.jpg',],
        'Program4' => [
                        'title'    => 'Loki',
                        'synopsis' => 'Les aventures de Loki à travers le temps',
                        'category' => 'Fantastique',
                        'poster'   => '/build/images/loki_poster.jpg',],
        'Program5' => [
                        'title'    => 'Bad Batch',
                        'synopsis' => 'Les aventures d\'une équipe de clone après l\'ordre 66',
                        'category' => 'Action',
                        'poster'   => '/build/images/bad_batch_poster.jpeg',],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programName => $programDetails) {
            $program = new Program();
            $program->setTitle($programDetails['title']);
            $program->setSynopsis($programDetails['synopsis']);
            $program->setCategory($this->getReference('category_' . $programDetails['category']));
            $program->setPoster($programDetails['poster']);
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }


}