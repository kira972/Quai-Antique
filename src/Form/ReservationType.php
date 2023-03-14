<?php

namespace App\Form;

use App\Entity\Allergie;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '50',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 2, 'max' => 50])
                ]
            ])
            ->add('date', DateType::class,[
                'label'=>'Jour', 
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'model_timezone' => 'Europe/Paris',
            ])
            ->add('hour', TimeType::class, [
                'label' => 'Heure',
                'input' => 'datetime',
                'widget' => 'choice',
                'hours' => [11, 12, 13, 14, 18, 19, 20, 21],
                'minutes' => [00, 15, 30, 45],
            ])
            ->add('numberCover', IntegerType::class, [
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
            ])
            ->add('allergie', EntityType::class, [
                'required' => false,
                'class' => Allergie::class,
                'mapped' => false,
                'multiple' => true,
                'expanded' => false,
                'label' => 'Allergies',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
