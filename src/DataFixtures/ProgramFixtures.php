<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    
    {
        $faker = Factory::create("fr_FR");
        
        for($i = 1; $i < 50; $i++) {
        $program = new Program();
        $program->setPoster('https://picsum.photos/id/3/200/300');
        $program->setTitle($faker->realText($maxNbChars = 20, $indexSize = 2));
        $program->setSynopsis($faker->realText($maxNbChars = 40, $indexSize = 2));
        $program->setCategory($this->getReference('category_' . $faker->randomElement(['Action', 'Animation', 'Comedy', 'Documentary', 'Drama', 'Horror', 'Romance', 'Sci-Fi', 'Thriller']) ));                                                                                                                                                         
        $this->addReference('program_'.$i , $program);
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
