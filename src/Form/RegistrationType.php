<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Allergie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('lastname', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'label' => 'Nom',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            // 'label_attr' => [
            //     'class' => 'form-label mt-4'
            // ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50])
            ]
        ])

        ->add('firstname', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',
            ],
            'label' => 'Prénom',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 2, 'max' => 50])
            ]
        ])

        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '180',
            ],
            'label' => 'Adresse email',
            'label_attr' => [
                'class' => 'form-label mt-4'
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email(),
                new Assert\Length(['min' => 2, 'max' =>180])
            ]
        ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => [
                        'class' => 'form-control mt-4 '
                    ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'mt-4 '
                    ]
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => 'Confirmation du mot de passe',
                    'label_attr' => [
                        'class' => 'mt-4 mb-2'
                    ]
                    ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.'
            ])

            // ->add('allergie', TextType::class,[
            //     'attr' => [
            //         'class' => 'form-control',
            //         'minlenght' => '5',
            //         'maxlenght' => '100',
            //     ],
            //     'required' => false,
            //     'label' => 'Vos Allergie (Facultatif) ',
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'constraints' => [
            //         new Assert\Length(['min' => 3, 'max' => 100])
            //     ]
            // ])
            ->add('allergie', EntityType::class, [
                'class' => Allergie::class,
                // 'choice_label' => function ($allergie) {
                //     return $allergie->getDescription();
                // }
                'attr' => [
                    'class' => 'checkbox-inputs'
                ],
                'required' => false,
                'choice_label' => "description" ,
                "mapped" => false,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Précisez vos allergies',
                'label_attr' => [
                    'class' => 'mt-4 mb-2'
                ]
                ])
            ->add('defaultNumberCover', IntegerType::class, [
                'label' => 'Couvert',
                'constraints' => [
                    new Assert\Range([
                        'min' => 1, 
                        'max' => 10,
                        'notInRangeMessage' => 'Le nombre de couvert doit être compris entre {{ min }} et {{ max }}',
                    ])
                ],
                'attr' => [
                    'min' => 1,
                    'max' => 10
                ]
            ]);
                
            // ->add('submit', SubmitType::class, [
            //     'attr' => [
            //         'class' => 'btn btn-primary mt-4'
            //     ]
            // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
