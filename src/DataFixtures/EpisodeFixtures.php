<?php

namespace App\DataFixtures;
use App\Entity\Season;
use App\Entity\Programme;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $episode = new Episode();
        $episode->setTitle('Meet');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_HeartStopper'));
        $episode->setSynopsis("Stuck in a secret relationship, shy Charlie starts to crush on Nick, the school's popular rugby star, and joins the team against his friends' advice.");
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Crush');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_HeartStopper'));
        $episode->setSynopsis("Charlie's friends fear he's doomed for romantic failure in liking Nick, whom word has it, has a serious girlfriend at Elle's school");
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Kiss');
        $episode->setNumber(3);
        $episode->setSeason($this->getReference('season1_HeartStopper'));
        $episode->setSynopsis("Charlie attends an upperclassman birthday party at Nick's invitation, a gathering he'd normally avoid like the plague.");
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Chapter 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Lupin'));
        $episode->setSynopsis("Years after a tragic injustice involving his father, Assane seeks to settle a score, and a debt, by stealing a diamond necklace. However, the heist takes an unexpected turn.");
        $manager->persist($episode);

        $episode = new Episode();
        $episode->setTitle('Chapter 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Lupin'));
        $episode->setSynopsis("Assane hatches a plot to contact Comet, an inmate who steers him to a clue about Babakar's demise. Anne Pellegrini comes clean about her past.");
        $manager->persist($episode);

        $manager->flush();

    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }

}