<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use App\Entity\AbstractEventEntity;
use App\Entity\Supplier;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * События, связанные с модлями
 *
 * Class PurchasePrice.
 *
 * @ORM\Entity()
 * @ORM\Table(name="models_purchase_prices")
 */
class PurchasePrice extends AbstractEntity
{
    /**
     * Модель
     *
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Model", inversedBy="purchasePrices")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"frontend"})
     */
    private $model;

    /**
     * Поставщик
     *
     * @var Supplier
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Supplier")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"frontend", "model"})
     */
    private $supplier;

    /**
     * Цена в валюте направления
     *
     * @var float
     *
     * @ORM\Column(type="float")
     * @Groups({"frontend", "model"})
     */
    private $price;

    /**
     * Закупочная цена в рублях
     *
     * @var float
     *
     * @ORM\Column(type="float", name="price_rur")
     * @Groups({"frontend", "model"})
     */
    private $priceRur;

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model): void
    {
        $this->model = $model;
    }

    /**
     * @return Supplier
     */
    public function getSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    /**
     * @param Supplier $supplier
     */
    public function setSupplier(Supplier $supplier): void
    {
        $this->supplier = $supplier;
    }

    /**
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPriceRur(): float
    {
        return $this->priceRur;
    }

    /**
     * @param float $priceRur
     */
    public function setPriceRur(float $priceRur): void
    {
        $this->priceRur = $priceRur;
    }
}
