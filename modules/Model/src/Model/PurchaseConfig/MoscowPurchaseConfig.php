<?php

namespace Model\Model\PurchaseConfig;

use App\Service\CbrfRatesService;
use Model\Entity\Model;

/**
 * Class MoscowPurchaseConfig
 * @package Model\Entity
 */
class MoscowPurchaseConfig implements PurchaseConfigInterface
{
    /**
     * Стоимость доставки товара на склад в рублях
     *
     * @var float
     */
    private $deliveryPrice = 0;

    /**
     * Бонусная часть мотивации закупщика в процентах
     *
     * @var float
     */
    private $motivationPercent = 0;

    /**
     * @return float
     */
    public function getDeliveryPrice(): float
    {
        return $this->deliveryPrice;
    }

    /**
     * @param float $deliveryPrice
     * @return MoscowPurchaseConfig
     */
    public function setDeliveryPrice(float $deliveryPrice): self
    {
        $this->deliveryPrice = $deliveryPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getMotivationPercent(): float
    {
        return $this->motivationPercent;
    }

    /**
     * @param float $motivationPercent
     * @return MoscowPurchaseConfig
     */
    public function setMotivationPercent(float $motivationPercent): self
    {
        $this->motivationPercent = $motivationPercent;

        return $this;
    }

    /**
     * Для закупки в МСК:
     * 1. Закупочная цена указывается в рублях
     * 2. Стоимость доставки товара на склад – 100 рублей (настраиваемое поле с точностью до десятой доли)
     * 3. Бонусная часть мотивации закупщика – 3% (настраиваемое поле для каждой категории товаров)
     * 4. Закупочная цена рассчитывается по формуле = закупочная цена + доставка + закупочная цена * бонус закупщика.
     *
     * @param Model $model
     * @param float $price
     * @param CbrfRatesService $cbrfRatesService
     * @return int
     */
    public function calculate(Model $model, float $price, CbrfRatesService $cbrfRatesService): int
    {
        return (int)($price + $this->getDeliveryPrice() + $price * $this->getMotivationPercent());
    }

    /**
     * @return string
     */
    public function serialize(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'deliveryPrice' => $this->getDeliveryPrice(),
            'motivationPercent' => $this->getMotivationPercent()
        ];
    }
}
