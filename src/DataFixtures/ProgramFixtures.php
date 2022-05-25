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
        $faker = Factory::create();
        
        for($i = 0; $i < 50; $i++) {
        $program = new Program();
        $program->setTitle('Title' .$faker->numberBetween(0,5) );
        $program->setSynopsis($faker->paragraphs(3, true));
        $program->setCategory($this->getReference('category_'.$i));
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
