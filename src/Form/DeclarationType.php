<?php

namespace App\Form;

use App\Entity\Detenteur;
use App\Entity\Declaration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeclarationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('detenteurs',EntityType::class,[
                'class' => Detenteur::class,
                'choice_label' => 'nomDetenteur'
                ])
            ->add('contenu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Declaration::class,
        ]);
    }
}
