<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/12/21
 * Time: 10:39 PM
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OpenToHiRepository")
 * @ORM\Table(name="ticker_open_to_hi")
 */
class TickerOpenToHi
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Ticker
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticker", inversedBy="openToHiPercentage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticker;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", scale=2, precision=11)
     */
    private $updated;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $day;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $lessThan10;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count10;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count20;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count30;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count40;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count50;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count60;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count70;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count80;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $count90;

    /**
     * @ORM\Column(type="integer",  nullable=true)
     */
    private $greaterThan100;

    public function __construct()
    {
        $this->lessThan10=0;
        $this->count10=0;
        $this->count20=0;
        $this->count30=0;
        $this->count40=0;
        $this->count50=0;
        $this->count60=0;
        $this->count70=0;
        $this->count80=0;
        $this->count90=0;
        $this->greaterThan100=0;
        $this->updated = new \DateTime();
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
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Ticker
     */
    public function getTicker(): Ticker
    {
        return $this->ticker;
    }

    /**
     * @param Ticker $ticker
     */
    public function setTicker(Ticker $ticker)
    {
        $this->ticker = $ticker;
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * @param int $day
     */
    public function setDay(int $day)
    {
        $this->day = $day;
    }

    /**
     * @return mixed
     */
    public function getLessThan10()
    {
        return $this->lessThan10;
    }

    public function setLessThan10()
    {
        $this->lessThan10 = $this->lessThan10 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount10()
    {
        return $this->count10;
    }

    public function setCount10()
    {
        $this->count10 = $this->count10 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount20()
    {
        return $this->count20;
    }

    public function setCount20()
    {
        $this->count20 = $this->count20 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount30()
    {
        return $this->count30;
    }

    public function setCount30()
    {
        $this->count30 = $this->count30 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount40()
    {
        return $this->count40;
    }

    public function setCount40()
    {
        $this->count40 = $this->count40 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount50()
    {
        return $this->count50;
    }

    public function setCount50()
    {
        $this->count50 = $this->count50 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount60()
    {
        return $this->count60;
    }

    public function setCount60()
    {
        $this->count60 = $this->count60 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount70()
    {
        return $this->count70;
    }

    public function setCount70()
    {
        $this->count70 = $this->count70 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount80()
    {
        return $this->count80;
    }

    public function setCount80()
    {
        $this->count80 = $this->count80 + 1;
    }

    /**
     * @return mixed
     */
    public function getCount90()
    {
        return $this->count90;
    }

    public function setCount90()
    {
        $this->count90 = $this->count90 + 1;
    }

    /**
     * @return mixed
     */
    public function getGreaterThan100()
    {
        return $this->greaterThan100;
    }

    public function setGreaterThan100()
    {
        $this->greaterThan100 = $this->greaterThan100 + 1;
    }

    public function getFrom0To20(): int
    {

       return ($this->lessThan10 + $this->count10 +$this->count20);
    }

    public function getFrom30To40()
    {
        return ($this->count30 + $this->count40);
    }

    public function getFrom50To60()
    {
        return ($this->count50 + $this->count60);
    }

    public function getFrom70To80()
    {
        return ($this->count70 + $this->count80);
    }

    public function getFrom90To100s()
    {
        return ($this->count90 + $this->greaterThan100);
    }
}