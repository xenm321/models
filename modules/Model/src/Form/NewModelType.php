<?php

namespace Model\Form;

use Model\Entity\Dictionary\Brand;
use Model\Entity\Dictionary\Type;
use Model\Entity\Model;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewModelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', EntityType::class, [
                'choice_label' => function (Type $type) {
                    return $type->getTitle();
                },
                'class' => Type::class,
                'label' => 'Тип',
            ])
            ->add('brand', EntityType::class, [
                'choice_label' => function (Brand $brand) {
                    return $brand->getTitle();
                },
                'class' => Brand::class,
                'label' => 'Бренд',
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
