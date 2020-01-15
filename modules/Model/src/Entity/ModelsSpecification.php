<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use App\Entity\Shop;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ModelsSpecification.
 *
 * @ORM\Entity()
 * @ORM\Table(name="models_specifications")
 */
class ModelsSpecification extends AbstractEntity
{
    /**
     * Модель
     *
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Model", inversedBy="specifications")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     * @Groups({"modelsList"})
     */
    private $model;

    /**
     * Спецификация
     *
     * @var Specification
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Specification")
     * @ORM\JoinColumn(name="specification_id", referencedColumnName="id")
     * @Groups({"modelsList"})
     */
    private $specification;

    /**
     * Значение
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"modelsList"})
     */
    private $value;

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
     * @return Specification
     */
    public function getSpecification(): Specification
    {
        return $this->specification;
    }

    /**
     * @param Specification $specification
     */
    public function setSpecification(Specification $specification): void
    {
        $this->specification = $specification;
    }

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
    }
}
