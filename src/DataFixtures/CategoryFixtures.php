<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Animation',
        'Comedy',
        'Documentary',
        'Drama',
        'Horror',                                                                                                                                                                                                                                                                                                        
        'Romance',
        'Sci-Fi',
        'Thriller',
    ];                                                                                                                                                                              
    public function load(ObjectManager $manager)
    {
        
        foreach (self::CATEGORIES as $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $categoryName, $category);
        }
        $manager->flush();
    }
}