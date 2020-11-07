<?php

namespace App\Form;

use App\Entity\Source;
use App\Entity\Mobilier;
use App\Entity\FournirMobilier;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FournirMobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sources',EntityType::class,[
                'class' => Source::class,
                'choice_label' => 'nomSource'
            ])
            
            ->add('mobiliers',EntityType::class,[
                'class' => Mobilier::class,
                'choice_label' => 'designation'
            ])

            ->add('prixMobilier',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            
            ->add('dateEntree', DateType::class, array(
                'widget' => 'single_text',
            ))

            ->add('nature', ChoiceType::class, array(
                'choices'  => array(
                    'Don' => 'Don',
                    'Achat' => 'Achat',
                    'Dotation' => 'Dotation'
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FournirMobilier::class,
        ]);
    }
}
