<?php

namespace Model\Form;

use Model\Entity\Dictionary\Brand;
use Model\Entity\Dictionary\Type;
use Model\Entity\Model;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketerModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'class' => Type::class,
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
            ])
            ->add('purchasePrices', CollectionType::class, [
                'entry_type' => PurchasePriceType::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
                'delete_empty' => true,
                'required' => false,
                'entry_options' => [
                    'label' => false,
                ],
            ])
            ->add('photos', CollectionType::class, [
                'entry_type' => ModelPhotoType::class,
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
            ->add('title', TextType::class)
            ->add('seoTitle', TextType::class)
            ->add('description', TextType::class)
            ->add('modelsExt', CollectionType::class, [
                'entry_type' => ModelExtType::class,
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
                'delete_empty' => true,
                'required' => false,
                'entry_options' => [
                    'label' => false,
                ],
            ])
            ->add('specifications', ModelSpecificationType::class, [
                'type' => $builder->getData()->getType()
            ]);
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Model::class,
            'cascade_validation' => true,
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
