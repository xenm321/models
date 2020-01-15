<?php

namespace Model\Form;

use App\Entity\Supplier;
use Model\Entity\PurchasePrice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PurchasePriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('supplier', EntityType::class, [
                'choice_label' => function (Supplier $supplier) {
                    return $supplier->getTitle();
                },
                'class' => Supplier::class,
                'label' => 'Поставщик',
            ])
            ->add('price', NumberType::class, [
                'label' => 'Закупочная цена'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PurchasePrice::class,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'purchasePrices';
    }
}
