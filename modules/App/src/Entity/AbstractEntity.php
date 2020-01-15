<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class AbstractEntity.
 */
abstract class AbstractEntity
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"frontend", "model"})
     *
     * @var int
     */
    protected $id;

    /**
     * Дата создания записи.
     *
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     * @Groups({"frontend"})
     */
    protected $created;

    /**
     * Дата обновления записи.
     *
     * @var \DateTime|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\DateTime
     * @Groups({"frontend"})
     */
    protected $updated;

    public function __construct()
    {
        $this->created = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated(): \DateTime
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     * @return $this
     */
    public function setCreated(\DateTime $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdated(): ?\DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     * @return $this
     */
    public function setUpdated(\DateTime $updated): self
    {
        $this->updated = $updated;

        return $this;
    }
}
