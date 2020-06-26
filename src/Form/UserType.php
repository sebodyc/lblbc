<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'adresse email'
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'user' => 'ROLE_USER',
                    'admin' => 'ROLE_ADMIN',
                    'moderateur' => 'ROLE_MODERATOR'
                ],
                'required' => true,
                'placeholder' => 'Choose an option',
                'expanded' => true,
                'multiple' => true,
            ])

            ->add('name')
            ->add('firtsName')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
