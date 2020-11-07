<?php

namespace App\Form;

use App\Entity\Source;
use App\Entity\Materiel;
use App\Entity\FournirMateriel;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class FournirMaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sources',EntityType::class,[
                'class' => Source::class,
                'choice_label' => 'nomSource'
            ])

            ->add('materiels',EntityType::class,[
                'class' => Materiel::class,
                'choice_label' => 'designation',
                'required' => false
            ])

            ->add('dateEntree',DateType::class, array(
                'widget' => 'single_text',
            ))

            ->add('qteEntree',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('prixMateriel',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ],
                'required' => false
            ])
            
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
            'data_class' => FournirMateriel::class,
        ]);
    }
}
