<?php

namespace App\Form;

use App\Entity\Mobilier;
use App\Entity\Entretien;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EntretienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateDebut',DateType::class, array(
                'widget' => 'single_text',
            ))
            
            ->add('dateFin',DateType::class, array(
                'widget' => 'single_text',
            ))

            ->add('prix',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])

            ->add('descriptionEntretien',TextareaType::class, array(
                'required' => false
            ))

            ->add('mobiliers',EntityType::class,[
                'class' => Mobilier::class,
                'choice_label' => 'codeMobilier'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entretien::class,
        ]);
    }
}
