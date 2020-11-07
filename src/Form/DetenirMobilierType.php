<?php

namespace App\Form;

use App\Entity\Mobilier;
use App\Entity\Detenteur;
use App\Entity\DetenirMobilier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DetenirMobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('detenteurs',EntityType::class,[
                'class' => Detenteur::class,
                'choice_label' => 'nomDetenteur'
            ])
            
            ->add('mobiliers',EntityType::class,[
                'class' => Mobilier::class,
                'choice_label' => 'designation'
            ])
            
            ->add('dateSortie',DateType::class, array(
                'widget' => 'single_text',
            ))
            ->add('qteSortie',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('lieu')
            ->add('dateRetour',DateType::class, array(
                'widget' => 'single_text',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DetenirMobilier::class,
        ]);
    }
}
