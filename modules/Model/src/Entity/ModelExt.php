<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use App\Entity\Shop;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Class ModelExt.
 *
 * @ORM\Entity(repositoryClass="Model\Repository\ModelExtRepository")
 * @ORM\Table(name="models_ext")
 */
class ModelExt extends AbstractEntity
{
    /**
     * Модель.
     *
     * @var Model
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Model", inversedBy="modelsExt")
     * @ORM\JoinColumn(name="model_id", referencedColumnName="id")
     * @Groups({"modelsList"})
     */
    private $model;

    /**
     * Магазин.
     *
     * @var Shop
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop")
     * @ORM\JoinColumn(name="shop_id", referencedColumnName="id")
     * @Groups({"modelsList", "model"})
     */
    private $shop;

    /**
     * Название на английском для магазина
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $title;

    /**
     * Название на русском для SEO для магазина
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $seoTitle;

    /**
     * PR-описание для магазина
     *
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"model"})
     */
    private $description;

    /**
     * Артикул.
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Groups({"modelsList", "model"})
     */
    private $articul;

    /**
     * Базовая цена на сайте.
     *
     * @var float
     *
     * @ORM\Column(type="decimal", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $price;

    /**
     * Полная стоимость моделей без скидок и акций.
     *
     * @var float
     *
     * @ORM\Column(type="decimal", name="full_price", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $fullPrice;

    /**
     * Фотографии модели для магазина
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\ModelExtPhoto",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="modelExt")
     * @Groups({"model"})
     * @var ArrayCollection|ModelExtPhoto[]
     */
    private $photos;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->photos = new ArrayCollection();
    }

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

    /**
     * @return Shop
     */
    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    /**
     * @param Shop $shop
     */
    public function setShop(Shop $shop): void
    {
        $this->shop = $shop;
    }

    /**
     * @return string
     */
    public function getArticul(): ?string
    {
        return $this->articul;
    }

    /**
     * @param string $articul
     */
    public function setArticul(string $articul): void
    {
        $this->articul = $articul;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getSeoTitle(): ?string
    {
        return $this->seoTitle;
    }

    /**
     * @param null|string $seoTitle
     */
    public function setSeoTitle(?string $seoTitle): void
    {
        $this->seoTitle = $seoTitle;
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
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getFullPrice(): ?float
    {
        return $this->fullPrice;
    }

    /**
     * @param float $fullPrice
     */
    public function setFullPrice(float $fullPrice): void
    {
        $this->fullPrice = $fullPrice;
    }

    /**
     * @return ArrayCollection|ModelExtPhoto[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param ArrayCollection|ModelExtPhoto[] $photos
     */
    public function setPhotos($photos): void
    {
        $this->photos = $photos;
    }

    public function addPhoto(ModelExtPhoto $photo)
    {
        $this->photos->add($photo);
        $photo->setModelExt($this);
    }

    public function removePhoto(ModelExtPhoto $photo)
    {
        $this->photos->removeElement($photo);
    }
}
