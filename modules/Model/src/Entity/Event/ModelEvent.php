<?php

namespace Model\Entity\Event;

use App\Entity\AbstractEvent;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Model;

/**
 * События, связанные с моделями
 *
 * Class ModelEvent.
 *
 * @ORM\Entity
 * @ORM\Table(name="models_events")
 */
class ModelEvent extends AbstractEvent
{
    // Создание артикула в магазине
    const TYPE_CREATE_MODEL_EXT = 'createModelExt';

    /**
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Model", inversedBy="events")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     */
    protected $model;

    /**
     * @return Model
     */
    public function getModel(): ?Model
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
}
