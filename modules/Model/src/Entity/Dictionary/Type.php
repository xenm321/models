<?php

namespace Model\Entity\Dictionary;

use App\Entity\Dictionary\AbstractDictionary;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Event\TypeEvent;
use Model\Entity\Specification;
use Model\Entity\TypePurchaseConfig;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Словарь типов моделей.
 *
 * Class Type
 *
 * @ORM\Entity(repositoryClass="Model\Repository\TypeRepository")
 * @ORM\Table(name="types")
 * @UniqueEntity("code")
 */
class Type extends AbstractDictionary
{
    // Балахон
    const TYPE_LOOSE_OVERALL = 'looseOverall';

    // Банный халат
    const TYPE_BATHROBE = 'bathrobe';

    // Барсетка
    const TYPE_MAN_BAG = 'manBag';

    // Блузка
    const TYPE_BLOUSE = 'blouse';

    // Браслет
    const TYPE_BRACELET = 'bracelet';

    // Брендовая коробка
    const TYPE_BRAND_BOX = 'brandBox';

    // Брошь
    const TYPE_BROOCH = 'brooch';

    // Визитница
    const TYPE_BUSINESS_CARD_CASE = 'businessCardCase';

    // Дипломат
    const TYPE_DIPLOMAT = 'diplomat';

    // Дорожная сумка
    const TYPE_TRAVEL_BAG = 'travelBag';

    // Ежедневник
    const TYPE_DATEBOOK = 'datebook';

    // Запонки
    const TYPE_CUFFLINKS = 'cufflinks';

    // Зонт
    const TYPE_UMBRELLA = 'umbrella';

    // Клатч
    const TYPE_CLUTCH = 'clutch';

    // Ключница
    const TYPE_KEY_BAG = 'keyBag';

    // Кольцо
    const TYPE_RING = 'ring';

    // Конверт
    const TYPE_ENVELOPE = 'envelope';

    // Коробка для браслетов
    const TYPE_BRACELET_BOX = 'braceletBox';

    // Коробка для бус
    const TYPE_BEADS_BOX = 'beadsBox';

    // Коробка для колец
    const TYPE_RING_BOX = 'ringBox';

    // Коробка для подвески
    const TYPE_PENDANT_BOX = 'pendantBox';

    // Коробка для серёжек
    const TYPE_EARRINGS_BOX = 'earringsBox';

    // Коробка под часы
    const TYPE_WATCH_BOX = 'watchBox';

    // Косметичка
    const TYPE_BEAUTY_BAG = 'beautyBag';

    // Костюм
    const TYPE_SUITE = 'suite';

    // Кошелек
    const TYPE_PURSE = 'purse';

    // Кошелёк КРЖ
    const TYPE_PURSE_KRJ = 'purseKRJ';

    // Культовая сумка
    const TYPE_CULT_BAG = 'cultBag';

    // Мужской портфель
    const TYPE_BRIEFCASE = 'briefcase';

    // Муфта для платков
    const TYPE_SHAWL_CLUTCH = 'shawlClutch';

    // Наборы украшений
    const TYPE_JEWELRY_SET = 'jewelrySet';

    // Наволочка
    const TYPE_PILLOWCASE = 'pillowcase';

    // Несессер
    const TYPE_DRESSING_BAG = 'dressingBag';

    // Обложка для паспорта
    const TYPE_PASSPORT_CASE = 'passportCase';

    // Обувь
    const TYPE_SHOES = 'shoes';

    // Обувь КРЖ
    const TYPE_SHOES_KRJ = 'shoesKRJ';

    // Органайзер
    const TYPE_ORGANISER = 'organiser';

    // Очки
    const TYPE_GLASSES = 'glasses';

    // Палантин
    const TYPE_TIPPET = 'tippet';

    // Папка для документов
    const TYPE_DOCUMENT_BAG = 'documentBag';

    // Парео
    const TYPE_PAREO = 'pareo';

    // Перчатки
    const TYPE_GLOVES = 'gloves';

    // Пижама
    const TYPE_PAJAMAS = 'pajamas';

    // Платок
    const TYPE_SHAWL = 'shawl';

    // Платье
    const TYPE_DRESS = 'dress';

    // Плед
    const TYPE_RUG = 'rug';

    // Повязка на голову
    const TYPE_HEADBAND = 'headband';

    // Подвеска
    const TYPE_PENDANT = 'pendant';

    // Полотенце
    const TYPE_TOWEL = 'towel';

    // Пончо
    const TYPE_PONCHO = 'poncho';

    // Портмоне для документов
    const TYPE_PORTFOLIO = 'portfolio';

    // Портупея
    const TYPE_SWORD_BELT = 'swordBelt';

    // Постельное белье
    const TYPE_BED_CLOTHES = 'bedClothes';

    // Почтальонка
    const TYPE_MESSENGER_BAG = 'messengerBag';

    // Ремень
    const TYPE_BELT = 'belt';

    // Ремень КРЖ
    const TYPE_BELT_KRJ = 'beltKRJ';

    // Рюкзак
    const TYPE_BACKPACK = 'backpack';

    // Серьги
    const TYPE_EARRINGS = 'earrings';

    // Спортивная сумка
    const TYPE_SPORT_BAG = 'sportBag';

    // Сумка
    const TYPE_BAG = 'bag';

    // Сумка КРЖ
    const TYPE_BAG_KRJ = 'bagKRJ';

    // Халат
    const TYPE_DRESSING_GOWN = 'dressingGown';

    // Чайный сервиз
    const TYPE_TEA_SET = 'teaSet';

    // Часы
    const TYPE_WATCH = 'watch';

    // Часы золотые
    const TYPE_GOLD_WATCH = 'goldWatch';

    // Часы-браслет
    const TYPE_WRISTLET_WATCH = 'wristletWatch';

    // Часы-дубликаты
    const TYPE_DUPLICATES_WATCH = 'duplicatesWatch';

    // Чемодан
    const TYPE_SUITCASE = 'suitcase';

    // ToDo: уточнить тип
    // Чехол
    const TYPE_PHONE_CASE = 'phoneCase';

    // Шарф
    const TYPE_SCARF = 'scarf';

    // Шляпа
    const TYPE_HAT = 'hat';

    // Шуба
    const TYPE_FUR_COAT = 'furCoat';

    // Шуберы
    const TYPE_SHUBER = 'shuber';

    /**
     * Идентификатор типа (для формирования артикула).
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Groups({"typesList"})
     */
    private $identifier;

    /**
     * Модели в магазинах
     *
     * @var ArrayCollection|TypePurchaseConfig[]
     *
     * @ORM\OneToMany(targetEntity="Model\Entity\TypePurchaseConfig",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="type")
     */
    private $purchaseConfig;

    /**
     * Спецификации модели для данного типа
     *
     * @var Specification[]
     *
     * @ORM\ManyToMany(targetEntity="Model\Entity\Specification", inversedBy="types")
     * @ORM\JoinTable(name="types_specifications")
     */
    private $specifications;

    /**
     * События
     *
     * @var ArrayCollection|TypeEvent[]
     *
     * @ORM\OneToMany(targetEntity="\Model\Entity\Event\TypeEvent",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="modelType")
     */
    private $events;

    /**
     * Type constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->purchaseConfig = new ArrayCollection();
        $this->specifications = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return ArrayCollection|TypePurchaseConfig[]
     */
    public function getPurchaseConfig()
    {
        return $this->purchaseConfig;
    }

    /**
     * @param ArrayCollection|TypePurchaseConfig[] $purchaseConfig
     */
    public function setPurchaseConfig($purchaseConfig): void
    {
        $this->purchaseConfig = $purchaseConfig;
    }

    /**
     * @return Specification[]
     */
    public function getSpecifications()
    {
        return $this->specifications;
    }

    /**
     * @param Specification[] $specifications
     */
    public function setSpecifications(array $specifications): void
    {
        $this->specifications = $specifications;
    }

    /**
     * @return ArrayCollection|TypeEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection|TypeEvent[] $events
     */
    public function setEvents($events): void
    {
        $this->events = $events;
    }
}
