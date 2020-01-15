<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use App\Entity\Direction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Dictionary\Type;
use Model\Entity\Event\TypePurchaseConfigEvent;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Параметра для рассчёта закупочной цены
 *
 * Class TypePurchaseConfig.
 *
 * @ORM\Entity()
 * @ORM\Table(name="type_purchase_configs")
 */
class TypePurchaseConfig extends AbstractEntity
{
    /**
     * Назправление закупки
     *
     * @var Direction
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Direction")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"frontend"})
     */
    private $direction;

    /**
     * Тип модели
     *
     * @var Type
     *
     * @ORM\ManyToOne(targetEntity="\Model\Entity\Dictionary\Type", inversedBy="purchaseConfig")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"frontend"})
     */
    private $type;

    /**
     * Конфигурация
     *
     * @var array
     *
     * @ORM\Column(type="json_document", options={"jsonb": true})
     * @Groups({"frontend"})
     */
    private $config;

    /**
     * События
     *
     * @var ArrayCollection|TypePurchaseConfigEvent[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\Event\TypePurchaseConfigEvent",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="config")
     */
    private $events;

    /**
     * TypePurchaseConfig constructor.
     * @param ArrayCollection|TypePurchaseConfigEvent[] $events
     */
    public function __construct($events)
    {
        parent::__construct();
        $this->events = new ArrayCollection();
    }

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * @param Direction $direction
     * @return TypePurchaseConfig
     */
    public function setDirection(Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return TypePurchaseConfig
     */
    public function setType(Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return TypePurchaseConfig
     */
    public function setConfig(array $config): self
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return ArrayCollection|TypePurchaseConfigEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection|TypePurchaseConfigEvent[] $events
     */
    public function setEvents($events): void
    {
        $this->events = $events;
    }
}
