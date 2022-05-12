<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('picture', FileType::class, [
                'label' => 'Image de la chambre',
                'mapped' => false,
                'constraints' => [
                    new File([
                        'mimeTypesMessage' => 'Inserez une photo du bon format',
                    ])
                ],
            ])
            ->add('descirption')
            ->add('price')
            ->add('pictures', FileType::class, [
                'label' => 'Images de la chambre',
                'multiple' => true,
                'constraints' => [
                    new File([
                        'mimeTypesMessage' => 'Inserez une photo du bon format',
                    ])
                ],
            ])
            ->add('lienbooking')
            ->add('hotel')
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
    }
}
