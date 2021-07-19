<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\Secteur;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\AtLeastOneOf;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr'=> array(
                    'class'=>'form-control mb-3',
                    'placeholder'=>'Indiquez un nom'
                )
            ])

            ->add('prenom', TextType::class, [
                'attr'=> array(
                    'class'=>'form-control mb-3',
                    'placeholder'=>'Indiquez un prenom'
                )
            ])

            ->add('email', EmailType::class, [
                'attr'=> array(
                    'class'=>'form-control mb-3',
                    'placeholder'=>'Indiquez un email'
                ),
            ])

            ->add('password', PasswordType::class, [
                'attr'=> array(
                    'class'=>'form-control mb-3',
                    'placeholder'=>'Indiquez un mot de passe'
                ),
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Le mot de passe doit contenir au moins 8 caractères',
                    ]),
                    // new AtLeastOneOf("\d+"),
                ],
                'required' => true,
            ])

            ->add('photo', FileType::class, [
                'label' => 'Photo employé ',
                'attr' => [
                    'class'=>'mb-3',
                ],
                'mapped' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Fichier invalide',
                        'maxSizeMessage'=> 'Fichier trop lourd',
                    ])
                ],
            ])

            ->add('contrat', EntityType::class,[
                'class' => Contrat::class,
                'attr'=> array(
                    'class'=> 'form-select mb-3',
                )
            ])

            ->add('depart', DateType::class, [
                'attr'=> array(
                    'class'=> 'mb-3',
                )
            ])

            ->add('secteur', EntityType::class, [
                'class' => Secteur::class,
                'attr' => array(
                    'class'=> 'form-select mb-3',
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
