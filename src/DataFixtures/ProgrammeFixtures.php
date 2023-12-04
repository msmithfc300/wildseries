<?php

namespace App\DataFixtures;
use App\Entity\Programme;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgrammeFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {

        $programme = new Programme();
        $programme->setTitle('HeartStopper');
        $programme->setSynopsis('two boys fall in love');
        $programme->setCategory($this->getReference('category_Animation'));
        $this->addReference('programme_1', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Lupin');
        $programme->setSynopsis('Guy plays out stories from the book series Lupin');
        $programme->setCategory($this->getReference('category_Action'));
        $this->addReference('programme_2', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Spaced');
        $programme->setSynopsis('Flatmates in London');
        $programme->setCategory($this->getReference('category_Action'));
        $this->addReference('programme_3', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Tokyo Vice');
        $programme->setSynopsis('American journalist moves to Japan and writes about the Yakuza');
        $programme->setCategory($this->getReference('category_Action'));
        $this->addReference('programme_4', $programme);
        $manager->persist($programme);

        $programme = new Programme();
        $programme->setTitle('Scooby Doo');
        $programme->setSynopsis('Dog and his mates unmask master criminals');
        $programme->setCategory($this->getReference('category_Horror'));
        $this->addReference('programme_5', $programme);
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
