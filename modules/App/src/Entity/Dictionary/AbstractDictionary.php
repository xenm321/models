<?php

namespace App\Entity\Dictionary;

use App\Entity\AbstractEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AbstractDictionary.
 */
abstract class AbstractDictionary extends AbstractEntity
{
    /**
     * Уникальный код записи латиницей.
     *
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     * @Groups({"frontend"})
     */
    protected $code;

    /**
     * Уникальное название.
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Groups({"frontend", "model"})
     */
    protected $title;

    /**
     * Описание.
     *
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"frontend"})
     */
    protected $description;

    /**
     * @return string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return $this
     */
    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
