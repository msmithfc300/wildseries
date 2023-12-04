<?php

namespace App\DataFixtures;
use App\Entity\Season;
use App\Entity\Programme;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
class SeasonFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();


            for ($seasonNumber = 1; $seasonNumber < 6; $seasonNumber++) {


                $season = new Season();
                $season->setNumber($seasonNumber); // 5 seasons per series
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgramme($this->getReference('programme_' . $faker->numberBetween(1, 5)));
                $this->addReference('season_' . $seasonNumber, $season); // change from add to set due to error advice?
                $manager->persist($season);


                $manager->flush();

            }
        }



    public function getDependencies(): array

    {

        return [

            ProgrammeFixtures::class,

        ];

    }






}