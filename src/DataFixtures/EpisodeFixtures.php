<?php

namespace App\DataFixtures;
use App\Entity\Season;
use App\Entity\Programme;
use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {

        //  $episode = new Episode();
        //  $episode->setTitle('Meet');
        //  $episode->setNumber(1);
        //  $episode->setSeason($this->getReference('season1_HeartStopper'));
        //   $episode->setSynopsis("Stuck in a secret relationship, shy Charlie starts to crush on Nick, the school's popular rugby star, and joins the team against his friends' advice.");
        // $manager->persist($episode);


        //need 10 episodes per season
        $faker = Factory::create();

        for($programmeNumber = 1; $programmeNumber < 6; $programmeNumber++) {
            for ($seasonNumber = 1; $seasonNumber < 6; $seasonNumber++) {
                for ($episodeNumber = 1; $episodeNumber < 11; $episodeNumber++) {

                    $episode = new Episode();
                    $episode->setTitle($faker->words(5, true));
                    $episode->setNumber($episodeNumber);
                    $episode->setSeason($this->getReference('season_' . $seasonNumber));
                    $episode->setSynopsis($faker->text());
                    $this->setReference('episode_' . $episodeNumber, $episode);
                    $manager->persist($episode);
                }
            }
        }

        $manager->flush();
    }



}