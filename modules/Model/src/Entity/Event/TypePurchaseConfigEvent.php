<?php

namespace Model\Entity\Event;

use App\Entity\AbstractEvent;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\TypePurchaseConfig;

/**
 * События, связанные с изменением параметров рассчёта закупочной цены
 *
 * Class TypePurchaseConfigEvent.
 *
 * @ORM\Entity
 * @ORM\Table(name="type_purchase_configs_events")
 */
class TypePurchaseConfigEvent extends AbstractEvent
{
    /**
     * @var TypePurchaseConfig
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\TypePurchaseConfig", inversedBy="events")
     * @ORM\JoinColumn(name="config_id", referencedColumnName="id")
     */
    protected $config;

    /**
     * @return TypePurchaseConfig
     */
    public function getConfig(): TypePurchaseConfig
    {
        return $this->config;
    }

    /**
     * @param TypePurchaseConfig $config
     */
    public function setConfig(TypePurchaseConfig $config): void
    {
        $this->config = $config;
    }
}
