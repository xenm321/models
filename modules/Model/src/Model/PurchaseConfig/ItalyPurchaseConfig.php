<?php

namespace Model\Model\PurchaseConfig;

use App\Service\CbrfRatesService;
use Model\Entity\Model;

/**
 * Class ItalyPurchaseConfig
 * @package Model\Entity
 */
class ItalyPurchaseConfig implements PurchaseConfigInterface
{
    /**
     * Доставка до склада в МСК за килограмм
     *
     * @var float
     */
    private $deliveryPrice = 0;

    /**
     * Стоимость проверки закупщиком одной единицы в USD
     *
     * @var float
     */
    private $checkPrice = 0;

    /**
     * Стоимость упаковки единицы продукции в USD
     *
     * @var float
     */
    private $packagingPrice = 0;

    /**
     * Мотивация группы закупки в USD
     *
     * @var float
     */
    private $motivationPrice = 0;

    /**
     * Мотивация группы закупки в USD
     *
     * @var float
     */
    private $searchPrice = 0;

    /**
     * @return float
     */
    public function getDeliveryPrice(): float
    {
        return $this->deliveryPrice;
    }

    /**
     * @param float $deliveryPrice
     * @return ItalyPurchaseConfig
     */
    public function setDeliveryPrice(float $deliveryPrice): self
    {
        $this->deliveryPrice = $deliveryPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getCheckPrice(): float
    {
        return $this->checkPrice;
    }

    /**
     * @param float $checkPrice
     * @return ItalyPurchaseConfig
     */
    public function setCheckPrice(float $checkPrice): self
    {
        $this->checkPrice = $checkPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getPackagingPrice(): float
    {
        return $this->packagingPrice;
    }

    /**
     * @param float $packagingPrice
     * @return ItalyPurchaseConfig
     */
    public function setPackagingPrice(float $packagingPrice): self
    {
        $this->packagingPrice = $packagingPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getMotivationPrice(): float
    {
        return $this->motivationPrice;
    }

    /**
     * @param float $motivationPrice
     * @return ItalyPurchaseConfig
     */
    public function setMotivationPrice(float $motivationPrice): self
    {
        $this->motivationPrice = $motivationPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getSearchPrice(): float
    {
        return $this->searchPrice;
    }

    /**
     * @param float $searchPrice
     * @return ItalyPurchaseConfig
     */
    public function setSearchPrice(float $searchPrice): self
    {
        $this->searchPrice = $searchPrice;

        return $this;
    }

    /**
     * Для закупки в Италии:
     * 1. Закупочная цена указывается в юанях
     * 2. Доставка до склада в МСК стоит 7 USD за килограмм (настраиваемое поле)
     * 3. Проверка в Италии одной единицы стоит 2 USD (для каждой категории товаров настраиваемое поле с точностью до десятой доли)
     * 4. Упаковка единицы продукции 0,5 USD (для каждой категории товаров настраиваемое поле с точностью до десятой доли)
     * 5. Мотивация группы закупки 2 USD (для каждой категории товаров настраиваемое поле с точностью до десятой доли)
     * 6. Время за поиск товара 0,5 USD (для каждой категории товаров настраиваемое поле с точностью до десятой доли)
     * 7. Закупочная цена рассчитывается по формуле =
     *        закупочная цена * курс юаня по курсу ЦБРФ на дату формирования артикула
     *        + ( вес товара * 7 USD доставки
     *            + стоимость проверки
     *            + стоимость упаковки
     *            + мотивация закупщиков
     *            + стоимость поиска товара ) * курс USD по курсу ЦБРФ на дату формирования артикула
     *
     * @param Model $model
     * @param float $price
     * @param CbrfRatesService $cbrfRatesService
     * @return int
     */
    public function calculate(Model $model, float $price, CbrfRatesService $cbrfRatesService): int
    {
        // ToDo: CbrfRatesService
        $yuanRate = 9.26;
        $USDRate  = 63.13;

        return (int)($price * $yuanRate
            + (
                $model->getWeight() * $this->getDeliveryPrice()
                + $this->getCheckPrice()
                + $this->getPackagingPrice()
                + $this->getMotivationPrice()
                + $this->getSearchPrice()
            ) * $USDRate);
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
            'checkPrice' => $this->getCheckPrice(),
            'packagingPrice' => $this->getPackagingPrice(),
            'motivationPrice' => $this->getMotivationPrice(),
            'searchPrice' => $this->getSearchPrice(),
        ];
    }
}
