<?php

namespace App\DataFixtures;
use App\Entity\Season;
use App\Entity\Programme;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies(): array
    {
        return [
            ProgrammeFixtures::class,
        ];
    }

    public function load(ObjectManager $manager): void
    {

        $season = new Season();
        $season->setNumber(1);
        $season->setProgramme($this->getReference('programme_HeartStopper'));
        $season->setYear(2022);
        $season->setDescription("Charlie and Nick's friendship develops into something more, but they face obstacles in the form of secrets, misunderstandings, and questioning their own identities.");
        $this->addReference('season1_HeartStopper', $season);
        $manager->persist($season);


        $season = new Season();
        $season->setNumber(2);
        $season->setProgramme($this->getReference('programme_HeartStopper'));
        $season->setYear(2023);
        $season->setDescription("Follows the lives of Nick, Charlie and their friends as they face new challenges in life, love and friendship: including a school trip to Paris, a prom and an unwelcome visit from Nick's homophobic older brother.");
        $this->addReference('season2_HeartStopper', $season);
        $manager->persist($season);


        $season = new Season();
        $season->setNumber(1);
        $season->setProgramme($this->getReference('programme_Lupin'));
        $season->setYear(2021);
        $season->setDescription("Assane Diop plans the theft of an expensive diamond necklace, once owned by Marie-Antoinette, which his father Babakar had been accused of stealing from the wealthy Pellegrini family 25 years earlier. ");
        $this->addReference('season1_Lupin', $season);
        $manager->persist($season);


        $season = new Season();
        $season->setNumber(2);
        $season->setProgramme($this->getReference('programme_Lupin'));
        $season->setYear(2023);
        $season->setDescription("the couple frantically work to track down their son's location, with the help of detective Youssef Guedira (Soufiane Guerrab). They manage to uncover that Leonard is holding Raoul captive in a stately home. Once Assanne works out Youssef is with the police he decides to go it alone to rescue his son.");
        $this->addReference('season2_Lupin', $season);
        $manager->persist($season);

        $manager->flush();



    }




}