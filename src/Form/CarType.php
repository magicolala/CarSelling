<?php

namespace App\Form;

use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $energies = [];
        foreach (Car::$energies as $energy) {
            $energies[$energy] = $energy;
        }

        $builder
            ->add('year')
            ->add('kilometrage')
            ->add('energie', ChoiceType::class, [
                'choices' => $energies
            ])
            ->add('nbPorte', ChoiceType::class, [
                'choices' => [
                    3 => 2,
                    5 => 4,
                    '5+' => 6
                ]
            ])
            ->add('category', ChoiceType::class, [
                'choices' => array_flip(Car::$categories)
            ])
            ->add('boite_de_vitesse', ChoiceType::class, [
                'choices' => [
                    'Automatique' => 'automatic',
                    'Manuelle'    => 'manual'
                ]
            ])
            ->add('description')
            ->add('prix')
            ->add('note')
            ->add('city')
            ->add('brand')
            ->add('model')
            ->add('img')
            ->add('Enregistrer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                                   'data_class' => Car::class,
                               ]);
    }
}
