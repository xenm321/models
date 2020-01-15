<?php

namespace Model\Entity;

use App\Entity\AbstractEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Event\ModelEvent;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * Class Model.
 *
 * @ORM\Entity(repositoryClass="Model\Repository\ModelRepository")
 * @ORM\Table(name="models")
 */
class Model extends AbstractEntity
{
    // Новинка - закупщик завёл новую модель
    const STATUS_NEW = 'new';

    // Заполнение характеристик кладовщиком и маркетологом
    const STATUS_PREPARE = 'prepare';

    // Активная - выставлена на сайте
    const STATUS_ACTIVE = 'active';

    // Архив
    const STATUS_ARCHIVE = 'archive';

    /**
     * Стаутус
     *
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $status = self::STATUS_NEW;

    /**
     * Название на английском
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $title;

    /**
     * Название на русском для SEO.
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $seoTitle;

    /**
     * PR-описание.
     *
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $description;

    /**
     * Артикул оригинальной модели.
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $originalArticul;

    /**
     * Тип модели.
     *
     * @var Dictionary\Type
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Dictionary\Type")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"modelsList", "model"})
     * @MaxDepth(1)
     */
    private $type;

    /**
     * Бренд.
     *
     * @var Dictionary\Brand
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Dictionary\Brand")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"modelsList", "model"})
     * @MaxDepth(1)
     */
    private $brand;

    /**
     * Цена оригинала в USD.
     *
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $originalPrice;

    /**
     * Цена оригинала в рублях.
     *
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $originalPriceRur;

    /**
     * Вес в граммах.
     *
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $weight;

    /**
     * Пол.
     *
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"modelsList", "model"})
     */
    private $gender;

    /**
     * Спецификации модели.
     *
     * @var ArrayCollection|ModelsSpecification[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\ModelsSpecification", mappedBy="model",
     *  fetch="LAZY", cascade={"persist", "remove"})
     */
    private $specifications;

    /**
     * Модели в магазинах
     *
     * @var ArrayCollection|ModelExt[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\ModelExt",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="model")
     * @Groups({"model"})
     */
    private $modelsExt;

    /**
     * Фотографии модели
     *
     * @var ArrayCollection|ModelPhoto[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\ModelPhoto",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="model")
     * @Groups({"model"})
     */
    private $photos;

    /**
     * Закупочные цены
     *
     * @var ArrayCollection|PurchasePrice[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\PurchasePrice",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="model")
     * @Groups({"model"})
     */
    private $purchasePrices;

    /**
     * События
     *
     * @var ArrayCollection|ModelEvent[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\Event\ModelEvent",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="model")
     */
    private $events;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->specifications = new ArrayCollection();
        $this->modelsExt = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->purchasePrices = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
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
     * @return null|string
     */
    public function getOriginalArticul(): ?string
    {
        return $this->originalArticul;
    }

    /**
     * @param null|string $originalArticul
     */
    public function setOriginalArticul(?string $originalArticul): void
    {
        $this->originalArticul = $originalArticul;
    }

    /**
     * @return Dictionary\Type
     */
    public function getType(): Dictionary\Type
    {
        return $this->type;
    }

    /**
     * @param Dictionary\Type $type
     */
    public function setType(Dictionary\Type $type): void
    {
        $this->type = $type;
    }

    /**
     * @return Dictionary\Brand
     */
    public function getBrand(): Dictionary\Brand
    {
        return $this->brand;
    }

    /**
     * @param Dictionary\Brand $brand
     */
    public function setBrand(Dictionary\Brand $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return int|null
     */
    public function getOriginalPrice(): ?int
    {
        return $this->originalPrice;
    }

    /**
     * @param int|null $originalPrice
     */
    public function setOriginalPrice(?int $originalPrice): void
    {
        $this->originalPrice = $originalPrice;
    }

    /**
     * @return int|null
     */
    public function getOriginalPriceRur(): ?int
    {
        return $this->originalPriceRur;
    }

    /**
     * @param int|null $originalPriceRur
     */
    public function setOriginalPriceRur(?int $originalPriceRur): void
    {
        $this->originalPriceRur = $originalPriceRur;
    }

    /**
     * @return int|null
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * @param int|null $weight
     */
    public function setWeight(?int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return null|string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param null|string $gender
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return ArrayCollection|ModelsSpecification[]
     */
    public function getSpecifications()
    {
        return $this->specifications;
    }

    /**
     * @param ArrayCollection|ModelsSpecification[] $specifications
     */
    public function setSpecifications($specifications): void
    {
        $this->specifications = $specifications;
    }

    /**
     * @return ArrayCollection|ModelExt[]
     */
    public function getModelsExt()
    {
        return $this->modelsExt;
    }

    /**
     * @param ArrayCollection|ModelExt[] $modelsExt
     */
    public function setModelsExt($modelsExt): void
    {
        $this->modelsExt = $modelsExt;
    }

    /**
     * @return ArrayCollection|ModelPhoto[]
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * @param ArrayCollection|ModelPhoto[] $photos
     */
    public function setPhotos($photos): void
    {
        $this->photos = $photos;
    }

    public function addPhoto(ModelPhoto $photo)
    {
        $this->photos->add($photo);
        $photo->setModel($this);
    }

    public function removePhoto(ModelPhoto $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * @return ArrayCollection|PurchasePrice[]
     */
    public function getPurchasePrices()
    {
        return $this->purchasePrices;
    }

    /**
     * @param ArrayCollection|PurchasePrice[] $purchasePrices
     */
    public function setPurchasePrices($purchasePrices): void
    {
        $this->purchasePrices = $purchasePrices;
    }

    /**
     * @param PurchasePrice $purchasePrice
     */
    public function addPurchasePrice(PurchasePrice $purchasePrice)
    {
        $this->purchasePrices->add($purchasePrice);
        $purchasePrice->setModel($this);
    }

    /**
     * @param PurchasePrice $attributeValue
     */
    public function removePurchasePrice(PurchasePrice $attributeValue)
    {
        $this->purchasePrices->removeElement($attributeValue);
    }

    /**
     * @return ArrayCollection|ModelEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection|ModelEvent[] $events
     */
    public function setEvents($events): void
    {
        $this->events = $events;
    }
}
