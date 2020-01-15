<?php

namespace Model\Entity;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ModelPhoto.
 *
 * @ORM\Entity
 * @ORM\Table(name="models_photos")
 * @Vich\Uploadable()
 */
class ModelPhoto extends AbstractPhoto
{
    // Фотография модели от поставщика
    const TYPE_SUPPLIER = 'supplier';

    /**
     * Модель.
     *
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Model", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $model;

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
