<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class ModelExtPhoto.
 *
 * @ORM\Entity
 * @ORM\Table(name="models_ext_photos")
 */
class ModelExtPhoto extends AbstractPhoto
{
    /**
     * Модель.
     *
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\ModelExt", inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modelExt;

    /**
     * @return Model
     */
    public function getModelExt(): ?Model
    {
        return $this->modelExt;
    }

    /**
     * @param Model $modelExt
     */
    public function setModelExt(Model $modelExt): void
    {
        $this->modelExt = $modelExt;
    }
}
