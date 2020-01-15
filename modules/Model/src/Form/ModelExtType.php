<?php

namespace Model\Form;

use App\Entity\Shop;
use Model\Entity\ModelExt;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelExtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('shop', EntityType::class, [
                'class' => Shop::class
            ])
            ->add('articul', TextType::class)
            ->add('title', TextType::class)
            ->add('seoTitle', TextType::class)
            ->add('description', TextType::class)
            ->add('price', NumberType::class)
            ->add('photos', CollectionType::class, [
                'entry_type' => ModelExtPhotoType::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
                'delete_empty' => true,
                'required' => false,
                'entry_options' => [
                    'label' => false,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ModelExt::class,
            'cascade_validation' => true,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'model_ext';
    }
}
