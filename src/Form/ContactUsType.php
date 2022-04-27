<?php

namespace App\Form;

use App\Entity\ContactUs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormTypeInterface;

class ContactUsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', TextType::class)
            ->add('list', ChoiceType::class, [
                'choices' => [
                    'Je souhaite poser une réclamation' => 0,
                    'Je souhaite commander un service supplémentaire' => 1,
                    'Je souhaite en savoir plus sur une suite' => 2,
                    'J\'ai un souci avec cette application' => 3,
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Précisez votre demande:'
            ])
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactUs::class,
        ]);
    }
}
