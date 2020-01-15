<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Характеристиик моделей
 * Class Specification.
 *
 * @ORM\Entity
 * @ORM\Table(name="specifications")
 */
class Specification extends AbstractEntity
{
    /**
     * @ORM\ManyToMany(targetEntity="Model\Entity\Dictionary\Type", mappedBy="specifications")
     */
    private $types;

    /**
     * Код характеристики
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Groups({"frontend"})
     */
    private $code;

    /**
     * Название характеристики
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Groups({"frontend"})
     */
    private $title;

    /**
     * Необходимое полномочие для редактирования поля
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     * @Groups({"frontend"})
     */
    private $role;

    /**
     * Specification constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->types = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param mixed $types
     */
    public function setTypes($types): void
    {
        $this->types = $types;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}