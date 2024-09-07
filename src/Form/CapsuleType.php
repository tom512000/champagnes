<?php

namespace App\Form;

use App\Entity\Capsule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class CapsuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('producteur', TextType::class, ['required' => false])
            ->add('couleur', TextType::class)
            ->add('inscription', TextType::class, ['required' => false])
            ->add('decoration', TextType::class, ['required' => false])
            ->add('lieu', TextType::class, ['required' => false])
            ->add('taille', TextType::class)
            ->add('coffret', CheckboxType::class, ['required' => false])
            ->add('prix', IntegerType::class, [
                'attr' => [
                    'min' => 0.00,
                    'step' => 0.01
                ],
                'required' => false
            ])
            ->add('etat', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 5
                ]
            ])
            ->add('quantite', IntegerType::class, [
                'attr' => [
                    'min' => 1
                ]
            ])
            ->add('image', FileType::class, [
                'label' => 'Image file',
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Capsule::class,
        ]);
    }
}
