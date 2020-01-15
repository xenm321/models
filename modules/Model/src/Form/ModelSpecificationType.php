<?php

namespace Model\Form;

use Model\Entity\Specification;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelSpecificationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * @var Specification[] $specifications
         */
        $specifications = $options['type']->getSpecifications();

        foreach ($specifications as $specification) {
            $builder
                ->add($specification->getId(), TextType::class, [
                    'mapped' => true,
                    'label' => $specification->getTitle(),
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['type']);
    }

    public function getBlockPrefix()
    {
        return 'specifications';
    }
}
