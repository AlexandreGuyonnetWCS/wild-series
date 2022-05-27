<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void

    {
        $faker = Factory::create("fr_FR");

        for($i = 1; $i < 15; $i++) {
            $episode = new Episode();
            $episode->setTitle('Title' . $faker->realText($maxNbChars = 10, $indexSize = 2) );
            $episode->setNumber($faker->numberBetween(1,15) );
            $episode->setSynopsis($faker->realText($maxNbChars = 50, $indexSize = 2));
            $episode->setSeason($this->getReference('season_' . rand(1,9)));
            $manager->persist($episode);
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