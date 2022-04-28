<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormTypeInterface;


class ManagerAddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('email', TextType::class, [
                'label' => 'Email :',
                'attr' => array(
                    'placeholder' => 'example')
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom :',
                'attr' => array(
                    'placeholder' => 'Dubois')
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Prenom :',
                'attr' => array(
                    'placeholder' => 'Jean-Didier')
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => 'Mot de passe :',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entre un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('gotHotel',EntityType::class, [
                'class' => Hotel::class,
                'choice_label' => 'name',
                'label' => 'Hotel à attribuer : '
                ])
            ->add('isVerified', CheckboxType::class, [
                'mapped' => false,
                'label' => 'J\'accepte le réglement du site.',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter le reglement.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, ['label'=>'Envoyer', 'attr'=>[
                'class'=>'button',
            ]])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
