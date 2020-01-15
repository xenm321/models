<?php

namespace Model\EventListener;

use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Model\Entity\PurchasePrice;
use Model\Calculator\PurchasePriceCalculator;

class CreateNewModelPurchasePriceListener
{
    /**
     * @var PurchasePriceCalculator
     */
    private $calculator;

    public function __construct(PurchasePriceCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if($object instanceof PurchasePrice) {
            $object->setPriceRur($this->calculator->calculate($object->getPrice()));
        }
    }
}
