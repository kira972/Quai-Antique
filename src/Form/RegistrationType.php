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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;

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
                'class' => 'form-label mt-3'
            ],
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
                'class' => 'form-label'
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
            'label' => 'Email',
            'label_attr' => [
                'class' => 'form-label mt-3'
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
                        'class' => 'form-control col-12'
                    ],
                    'label' => false,
                    'label_attr' => [
                        'class' => 'col-12 mt-3'
                    ]
                ],
                'second_options' => [
                    'attr' => [
                        'class' => 'form-control',
                    ],
                    'label' => false,
                    'label_attr' => [
                        'class' => 'col-12 mt-3'
                    ]
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern'=> '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{12,}$/',
                        'message' => 'Le mot de passe doit contenir minimum 12 caractères, 
                        au moins 1 lettre majuscule, 1 lettre minuscule, 1 chiffre et 1 caractère spécial'
                    ])
                ],
            ])
            ->add('allergie', EntityType::class, [
                'class' => Allergie::class,
                'attr' => [
                    'class' => 'checkbox-inputs'
                ],
                'required' => false,
                'choice_label' => "description" ,
                "mapped" => false,
                'multiple' => true,
                'expanded' => true,
                'label' => false,
                ])
            ->add('defaultNumberCover', IntegerType::class, [
                'label' => 'Couvert',
                'label_attr' => [
                    'class' => 'col-12 mt-3'
                ],
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
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
