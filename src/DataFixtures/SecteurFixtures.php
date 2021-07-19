<?php

namespace App\DataFixtures;

use App\Entity\Secteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SecteurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $secteurs = [
            ['name'=>'RH'],
            ['name'=>'Informatique'],
            ['name'=>'Comptabilité'],
            ['name'=>'Direction'],
        ];

        foreach ($secteurs as $secteur) {
            $object = new Secteur();
            $object->setName($secteur['name']);
            $manager->persist($object);

            $this->addReference('secteur-'.$secteur['name'], $object);
        }

        $manager->flush();
    }
}
