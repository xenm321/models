<?php

namespace Model\Entity\Event;

use App\Entity\AbstractEvent;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Model\Entity\Dictionary\Brand;

/**
 * События, связанные со словарём брендов
 *
 * Class BrandEvent.
 *
 * @ORM\Entity
 * @ORM\Table(name="brands_events")
 */
class BrandEvent extends AbstractEvent
{
    /**
     * @var Brand
     *
     * @ORM\ManyToOne(targetEntity="Model\Entity\Dictionary\Brand", inversedBy="events")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    protected $brand;

    /**
     * @return Brand
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    /**
     * @param Brand $brand
     */
    public function setBrand(Brand $brand): void
    {
        $this->brand = $brand;
    }
}
