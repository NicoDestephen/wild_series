<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    // const PROGRAMS = [];
    const PROGRAMS = [
        'Walking dead' => [
                        'synopsis' => 'Des zombies envahissent la terre',
                        'category' => 'Action',
                        'poster'   => '/build/images/walking_dead_poster.jpg',
                        'country'  => 'Etats-Unis',
                        'year'     => '2093',],
        'Stranger Things' => [
                        'synopsis' => 'Des enfants qui vont dans un monde parallèle',
                        'category' => 'Horreur',
                        'poster'   => '/build/images/stranger_things_poster.jpg',
                        'country'  => 'Etats-Unis',
                        'year'     => '1287',],
        'The Witcher' => [
                        'synopsis' => 'Un sorceleur qui tape des monstres',
                        'category' => 'Horreur',
                        'poster'   => '/build/images/the_witcher_poster.jpg',
                        'country'  => 'Etats-Unis',
                        'year'     => '7363',],
        'Loki' => [
                        'synopsis' => 'Les aventures de Loki à travers le temps',
                        'category' => 'Fantastique',
                        'poster'   => '/build/images/loki_poster.jpg',
                        'country'  => 'Etats-Unis',
                        'year'     => '6323',],
        'Bad Batch' => [
                        'synopsis' => 'Les aventures d\'une équipe de clone après l\'ordre 66',
                        'category' => 'Action',
                        'poster'   => '/build/images/bad_batch_poster.jpeg',
                        'country'  => 'Etats-Unis',
                        'year'     => '1998',],
        'Arcane' => [
                        'synopsis' => 'La série sur League of Legend',
                        'category' => 'Animation',
                        'poster'   => '/build/images/arcane_poster.jpg',
                        'country'  => 'Etats-Unis',
                        'year'     => '2934',],
    ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programName => $programDetails) {
            $program = new Program();
            $program->setTitle($programName);
            $program->setSynopsis($programDetails['synopsis']);
            $program->setCategory($this->getReference('category_' . $programDetails['category']));
            $program->setPoster($programDetails['poster']);
            $program->setCountry($programDetails['country']);
            $program->setYear($programDetails['year']);
            $this->setReference('program_' . $programName, $program);
            $manager->persist($program);
        }

        $manager->flush();

        // $faker = Factory::create();
        // foreach (CategoryFixtures::CATEGORIES as $category => $programDetails) {
        //     for($i = 0; $i < 5; $i++) {
        //         $program = new Program();
        
        //         $program->setTitle($programDetails['title']);
        //         $program->setSynopsis($faker->paragraphs(3, true));
        //         $program->setPoster($faker->imageUrl(640, 480, 'animals', true));
        //         $program->setCountry($faker->word());
        //         $program->setYear($faker->year());
        //         $program->setCategory($this->getReference('category_' . $category));
        //         $this->setReference('program_' . $programDetails['title'], $program);

        //         $manager->persist($program);
        //     }
        // }

        // $manager->flush();
    }

    public function getDependencies()
    {
        return [
          CategoryFixtures::class,
        ];
    }
}