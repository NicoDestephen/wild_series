<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];
    // const CATEGORIES = 'category';
    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();  
            $category->setName($categoryName);  
            $manager->persist($category);  
            $this->addReference('category_' . $categoryName, $category);
        }  
        $manager->flush();

        // $faker = Factory::create();

        // for($i = 0; $i < 5; $i++) {
        //     $category = new Category();
       
        //     $category->setName($faker->word());
        //     $this->setReference(self::CATEGORIES, $category);

        //     $manager->persist($category);
        // }
        // $manager->flush();
    }
}
