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

        $programme = new Programme();
        $programme->setTitle('HeartStopper');
        $programme->setSynopsis('two boys fall in love');
        $programme->setCategory($this->getReference('category_Animation'));
        $this->addReference('programme_HeartStopper', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Lupin');
        $programme->setSynopsis('Guy plays out stories from the book series Lupin');
        $programme->setCategory($this->getReference('category_Action'));
        $this->addReference('programme_Lupin', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Spaced');
        $programme->setSynopsis('Flatmates in London');
        $programme->setCategory($this->getReference('category_Action'));
        $this->addReference('programme_Spaced', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Tokyo Vice');
        $programme->setSynopsis('American journalist moves to Japan and writes about the Yakuza');
        $programme->setCategory($this->getReference('category_Action'));
        $this->addReference('programme_Tokyo_Vice', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Scooby Doo');
        $programme->setSynopsis('Dog and his mates unmask master criminals');
        $programme->setCategory($this->getReference('category_Horror'));
        $this->addReference('programme_Scooby_Doo', $programme);
        $manager->persist($programme);



$manager->flush();

}

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }

}
