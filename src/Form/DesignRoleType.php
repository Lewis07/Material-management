<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DesignRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class,[
                'label' => "Nom d'utilisateur"
            ])
            ->add('password',PasswordType::class,[
                'label' => 'Mot de passe'
            ])
            ->add('email',EmailType::class)
            ->add('role',ChoiceType::class,[
                'choices' => [
                    'ROLE_RESPONSABLE' => 'ROLE_RESPONSABLE',
                    'ROLE_DEPOSITAIRE' => 'ROLE_DEPOSITAIRE',
                ],
                'label' => 'Rôle',
                'attr' => [
                    'class' => 'mx-2 form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
