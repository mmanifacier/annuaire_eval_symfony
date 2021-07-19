<?php

namespace App\DataFixtures;

use App\Entity\Contrat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContratFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $contrats = [
            ['type'=>'CDI'],
            ['type'=>'CDD'],
            ['type'=>'Intérim'],
        ];

        foreach ($contrats as $contrat) {
            $object = new Contrat();
            $object->setType($contrat['type']);
            $manager->persist($object);

            $this->addReference('contrat-'.$contrat['type'], $object);
        }

        $manager->flush();
    }
}
