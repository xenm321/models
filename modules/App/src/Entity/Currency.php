<?php
namespace Mlg\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Currency - валюты
 *
 * @ORM\Entity
 * @ORM\Table(name="currencies")
 */
class Currency {
    // Китайский юань
    const CODE_CNY = 156;
    
    // Российский рубль
    const CODE_RUR = 643;
    
    // Американский доллар
    const CODE_USD = 840;
    
    // Евро
    const CODE_EUR = 978;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", name="code", nullable=true)
     * @var int
     */
    protected $code;

    /**
     * @ORM\Column(type="string", name="charCode", nullable=true)
     * @var string
     */
    protected $charCode;

    /**
     * @ORM\Column(type="string", name="title", nullable=true)
     * @var string
     */
    protected $title;

    /**
     * @ORM\Column(type="string", name="alias", nullable=true)
     * @var string
     */
    protected $alias;

    /**
     * Флаг архивной записи
     *
     * @ORM\Column(type="boolean", name="isArchive", nullable=true)
     * @var boolean
     */
    protected $isArchive = 0;

    /**
     * Статистика по статусам заказов
     *
     * @ORM\OneToMany(targetEntity="Mlg\Entity\CurrencyRate", mappedBy="currency", cascade={"all"})
     * @var ArrayCollection|CurrencyRate[]
     */
    protected $rates;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCharCode()
    {
        return $this->charCode;
    }

    /**
     * @param string $charCode
     */
    public function setCharCode($charCode)
    {
        $this->charCode = $charCode;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return boolean
     */
    public function getIsArchive()
    {
        return $this->isArchive;
    }

    /**
     * @return boolean
     */
    public function isArchive()
    {
        return $this->isArchive;
    }

    /**
     * @param boolean $isArchive
     */
    public function setIsArchive($isArchive)
    {
        $this->isArchive = $isArchive;
    }

}
