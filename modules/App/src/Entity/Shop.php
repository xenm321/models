<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class Shop.
 *
 * @ORM\Entity
 * @ORM\Table(name="shops")
 */
class Shop extends AbstractEntity
{
    // BagsBoutique
    const SHOP_BG = 'bg';

    // VipTime
    const SHOP_VT = 'vt';

    // LifeBox
    const SHOP_LB = 'lb';

    /**
     * Название на английском
     *
     * @var string|null
     *
     * @ORM\Column(type="string")
     * @Groups({"frontend"})
     */
    private $title;

    /**
     * Код.
     *
     * @var string|null
     *
     * @ORM\Column(type="string")
     * @Groups({"frontend"})
     */
    private $code;

    /**
     * PR-описание.
     *
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     * @return Shop
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     * @return Shop
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;

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
     * @return Shop
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function __toString()
    {
        return $this->getTitle();
    }
}
