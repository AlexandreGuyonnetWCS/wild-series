<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    public const TITLES = [
        'Walking dead',
        'Stranger Things',
        'Dark',
        'Bander Snatch',
        'Hunting Hill',

    ];

    public function load(ObjectManager $manager)
    
    {
        foreach (self::TITLES as $programTitle) {
           
        $program = new Program();
        $program->setTitle($programTitle);
        $program->setSynopsis('Une série qu elle est trop bien');
        $program->setCategory($this->getReference('category_Action'));
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
