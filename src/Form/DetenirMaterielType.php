<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\Detenteur;
use App\Entity\DetenirMateriel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class DetenirMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('detenteurs',EntityType::class,[
                'class' => Detenteur::class,
                'choice_label' => 'nomDetenteur'
            ])
            
            ->add('materiels',EntityType::class,[
                'class' => Materiel::class,
                'choice_label' => 'designation',
                'invalid_message' => 'Ce matériel est dejà detenu'
            ])

            ->add('dateSortie', DateTimeType::class, array(
                // 'placeholder' => 'Valeur',
            ))

            ->add('qteSortie',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('lieu')

            ->add('dateRetour', DateTimeType::class, array(
                // 'placeholder' => 'Valeur',
            ))

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetenirMateriel::class,
        ]);
    }
}
