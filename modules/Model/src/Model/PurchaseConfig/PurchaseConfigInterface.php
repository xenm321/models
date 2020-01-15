<?php

namespace Model\Model\PurchaseConfig;

use App\Service\CbrfRatesService;
use Model\Entity\Model;

/**
 * Interface PurchaseConfigInterface
 * @package Model\Model\PurchaseConfig
 */
interface PurchaseConfigInterface
{
    /**
     * Рассчёт закупочной стоимости в рублях для направления
     *
     * @param Model $model
     * @param float $price
     * @param CbrfRatesService $cbrfRatesService
     * @return int
     */
    public function calculate(Model $model, float $price, CbrfRatesService $cbrfRatesService): int;

    /**
     * @return string
     */
    public function serialize(): string;

    /**
     * @return array
     */
    public function toArray(): array;
}
