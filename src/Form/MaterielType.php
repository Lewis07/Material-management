<?php

namespace App\Form;

use App\Entity\Materiel;
use App\Entity\Categorie;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class MaterielType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomenclature',TextType::class,[
                'required' => false
            ])
            ->add('designation')
            ->add('qteInitiale',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('stock',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('stockAlerte',IntegerType::class,[
                'attr' => [
                    'min' => 0
                ]
            ])
            ->add('categorieMateriel',EntityType::class,[
                'class' => Categorie::class,
                'choice_label' => 'libelleCateg'
            ])
            ->add('service')
            
            ->add('etatRetourMateriel',ChoiceType::class,array(
                'choices' => [
                    'Bonne' => 'Bonne',
                    'Mauvaise' => 'Mauvaise'
                ]
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Materiel::class,
        ]);
    }
}
