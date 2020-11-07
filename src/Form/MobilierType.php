<?php

namespace App\Form;

use App\Entity\Mobilier;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MobilierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codeMobilier')
            ->add('designation')
            ->add('etat',ChoiceType::class,array(
                'choices' => [
                    'Bonne' => 'Bonne',
                    'Mauvaise' => 'Mauvaise'
                ]
            ))
            ->add('service')

            
            ->add('categorieMobilier',EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'libelleCateg'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Mobilier::class,
        ]);
    }
}
