<?php
namespace Mlg\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CurrencyRates - курсы валют
 *
 * @ORM\Entity
 * @ORM\Table(name="currency_rates")
 */
class CurrencyRate {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var integer
     */
    protected $id;

    /**
     * @ORM\Column(type="date", name="date", nullable=true)
     * @var \DateTime
     */
    protected $date;

    /**
     * Валюта
     *
     * @ORM\ManyToOne(targetEntity="Mlg\Entity\Currency", inversedBy="rates", cascade={"persist"})
     * @ORM\JoinColumn(name="currencyId", referencedColumnName="id")
     * @var Currency
     */
    protected $currency;

    /**
     * Курс за 1
     *
     * @ORM\Column(type="float", name="rate", nullable=true)
     * @var float
     */
    protected $rate;

    /**
     * CurrencyRate constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime();
    }


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
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return Currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    }
}
