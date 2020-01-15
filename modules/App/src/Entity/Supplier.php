<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Поставщик
 * Class Supplier.
 *
 * @ORM\Entity
 * @ORM\Table(name="suppliers")
 */
class Supplier extends AbstractEntity
{
    /**
     * Направление закупки
     *
     * @var Direction
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Direction")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"frontend", "modelsList"})
     */
    private $direction;

    /**
     * Название на английском
     *
     * @var string|null
     *
     * @ORM\Column(type="string")
     * @Groups({"frontend", "modelsList", "model"})
     */
    private $title;

    /**
     * PR-описание.
     *
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

    /**
     * @param Direction $direction
     * @return Supplier
     */
    public function setDirection(Direction $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     * @return Supplier
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     * @return Supplier
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
