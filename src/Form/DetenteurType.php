<?php

namespace App\Form;

use App\Entity\Fonction;
use App\Entity\Detenteur;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class DetenteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomDetenteur')
            ->add('contact',IntegerType::class,[
                'attr' => [
                    'min' => 0,
                ]
            ])
            ->add('fonction',EntityType::class,[
                'class' => Fonction::class,
                'choice_label' => 'libelle'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Detenteur::class,
        ]);
    }
}
