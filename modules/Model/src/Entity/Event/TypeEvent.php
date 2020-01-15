<?php

namespace Model\Entity\Event;

use App\Entity\AbstractEvent;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Dictionary\Type;

/**
 * События, связанные со словарём типов
 *
 * Class TypeEvent.
 *
 * @ORM\Entity
 * @ORM\Table(name="types_events")
 */
class TypeEvent extends AbstractEvent
{
    /**
     * @var Type
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Dictionary\Type", inversedBy="events")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    protected $modelType;

    /**
     * @return Type
     */
    public function getModelType(): Type
    {
        return $this->modelType;
    }

    /**
     * @param Type $modelType
     */
    public function setModelType(Type $modelType): void
    {
        $this->modelType = $modelType;
    }
}
