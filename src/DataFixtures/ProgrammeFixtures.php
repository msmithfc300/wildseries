<?php

namespace App\DataFixtures;
use App\Entity\Programme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgrammeFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMMES = [
        [
            'title' => 'HeartStopper',
            'synopsis' => 'two boys fall in love',
            'category' => 'category_Animation',
        ],

        [
            'title' => 'Lupin',
            'synopsis' => 'Guy plays out stories from the book series Lupin',
            'category' => 'category_Action',
        ],

        [
            'title' => 'SPACED',
            'synopsis' => 'Flatmates in London',
            'category' => 'category_Fantasy',
        ],

        [
            'title' => 'Tokyo Vice',
            'synopsis' => 'American journalist writes about the Yakuza',
            'category' => 'category_Action',
        ],

        [
            'title' => 'Scooby Doo',
            'synopsis' => 'Dog and his mates unmask master criminals',
            'category' => 'category_Horror',
        ],
    ];



    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMMES as $programmeDescription) {
            $programme = new Programme();

        $programme->setTitle($programmeDescription['title']);

        $programme->setSynopsis($programmeDescription['synopsis']);

        $programme->setCategory($this->getReference($programmeDescription['category']));

        $this->addReference('programme_' . $programmeDescription['title'], $programme);

        $manager->persist($programme);


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
