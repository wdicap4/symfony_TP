<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,  [
                'attr' => [
                    'class' =>'h-full-width'
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class' =>'h-full-width'
                ],

                'label' => "Mot de pass"
            ])
            ->add('firstName', TextType::class, [
                'attr' => [
                    'class' =>'h-full-width'
                ],
                'label' => "Nom d'utilisateur"
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' =>'h-full-width'
                ],
                'label' => "prenom d'utilisateur"
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
