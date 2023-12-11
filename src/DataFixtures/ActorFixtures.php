<?php

namespace App\DataFixtures;
use App\Entity\Programme;
use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {

            $actor = new Actor();
            $actor->setName(($faker->name));
            for ($p = 0; $p < 3; $p++) {
                $programme = $this->getReference('programme_' . rand(1, 5));
                $actor->addProgramme($programme);
            }

            $manager->persist($actor);
        }

        $manager->flush();
    }


    public function getDependencies(): array

    {

        return [

            ProgrammeFixtures::class,

        ];

    }
}