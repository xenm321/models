<?php

namespace Model\Entity\Dictionary;

use App\Entity\Dictionary\AbstractDictionary;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Event\BrandEvent;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Словарь брендов моделей.
 *
 * Class Brand
 *
 * @ORM\Entity(repositoryClass="Model\Repository\BrandRepository")
 * @ORM\Table(name="brands")
 * @UniqueEntity("code")
 */
class Brand extends AbstractDictionary
{
    /**
     * Идентификатор бренда (для формирования артикула).
     *
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Groups({"brandsList"})
     */
    private $identifier;

    /**
     * Текущий числовой идентификатор артикула внутри бренда
     *
     * @var integer
     *
     * @ORM\Column(type="integer", name="last_index_number")
     * @Assert\NotBlank
     */
    private $lastIndexNumber = 0;

    /**
     * События
     *
     * @var ArrayCollection|BrandEvent[]
     *
     * @ORM\OneToMany(targetEntity="\Model\Entity\Event\BrandEvent",
     *  fetch="LAZY", cascade={"persist", "remove"}, mappedBy="brand")
     */
    private $events;

    /**
     * Brand constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
     * @return int
     */
    public function getLastIndexNumber(): ?int
    {
        return $this->lastIndexNumber;
    }

    /**
     * @param int $lastIndexNumber
     */
    public function setLastIndexNumber(int $lastIndexNumber): void
    {
        $this->lastIndexNumber = $lastIndexNumber;
    }

    /**
     * @return int
     */
    public function incrementLastIndexNumber()
    {
        return $this->lastIndexNumber++;
    }

    /**
     * @return ArrayCollection|BrandEvent[]
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param ArrayCollection|BrandEvent[] $events
     */
    public function setEvents($events): void
    {
        $this->events = $events;
    }
}
