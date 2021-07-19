<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    /**
     * Class constructor.
     */
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $users = [
            [
                'nom'=>'Admin',
                'prenom'=>'Admin',
                'contrat'=>'CDI',
                'secteur'=>'RH',
                'photo'=>'https://humanbooster.com/wp-content/uploads/2021/02/intro-image.png',
                'email'=>'rh@humanbooster.com',
                'password'=>'rh123@',
                'isRH'=>true,
            ],
        ];

        foreach ($users as $user) {
            $object = new User();
            $object->setNom($user['nom']);
            $object->setPrenom($user['prenom']);
            $object->setContrat($this->getReference('contrat-'.$user['contrat']));
            $object->setSecteur($this->getReference('secteur-'.$user['secteur']));
            $object->setEmail($user['email']);
            $object->setPhoto($user['photo']);
            
            if ($user['isRH']) {
                $object->setRoles(['ROLE_RH']);
            }
            
            $object->setPassword($this->encoder->hashPassword($object, $user['password']));
            $manager->persist($object);
        }

        $manager->flush();
    }
}
