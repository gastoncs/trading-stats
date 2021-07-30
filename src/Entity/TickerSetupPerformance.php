<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/11/21
 * Time: 8:15 PM
 */

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TickerSetupPerformanceRepository")
 * @ORM\Table(name="ticker_setup_performance")
 */
class TickerSetupPerformance
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @var TickerPerformance
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\TickerPerformance", inversedBy="tickerSetupPerformances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tickerPerformance;

    /**
     * @var Tag[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist"})
     * @ORM\JoinTable(name="ticker_setup_perfomance_tag")
     * @ORM\OrderBy({"name": "ASC"})
     * @Assert\Count(max="6", maxMessage="post.too_many_tags")
     */
    private $tags;

    /**
     * @var Setup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $setup;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $bounceAtTheOpen;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $tankedAtTheOpen;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $choopyAtTheOpen;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $vwapRejection;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $vwapRejectionTime;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="price_hi", scale=2, precision=11)
     */
    private $hi;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $hiTime;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="price_low", scale=2, precision=11)
     */
    private $low;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $lowTime;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="hod_before_zb", scale=2, precision=11)
     */
    private $hodBeforeZb;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $zb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $zbTime;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="zb_hi", scale=2, precision=11)
     */
    private $zbHi;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="zb_hi_to_hod", scale=2, precision=11)
     */
    private $zbHiToHOD;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $adf;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $channelT;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $eodBreakdown;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $eodSqueeze;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $squeezeTime;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $aboveVwap330;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    public $chartLink;

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
     * @return \DateTime
     */
    public function getDatetime(): \DateTime
    {
        return $this->datetime;
    }

    /**
     * @param \DateTime $datetime
     */
    public function setDatetime(\DateTime $datetime)
    {
        $this->datetime = $datetime;
    }

    /**
     * @return Tag[]|Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag[]|Collection $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return Setup
     */
    public function getSetup(): Setup
    {
        return $this->setup;
    }

    /**
     * @param Setup $setup
     */
    public function setSetup(Setup $setup)
    {
        $this->setup = $setup;
    }

    /**
     * @return mixed
     */
    public function getBounceAtTheOpen()
    {
        return $this->bounceAtTheOpen;
    }

    /**
     * @param mixed $bounceAtTheOpen
     */
    public function setBounceAtTheOpen($bounceAtTheOpen)
    {
        $this->bounceAtTheOpen = $bounceAtTheOpen;
    }

    /**
     * @return mixed
     */
    public function getTankedAtTheOpen()
    {
        return $this->tankedAtTheOpen;
    }

    /**
     * @param mixed $tankedAtTheOpen
     */
    public function setTankedAtTheOpen($tankedAtTheOpen)
    {
        $this->tankedAtTheOpen = $tankedAtTheOpen;
    }

    /**
     * @return mixed
     */
    public function getChoopyAtTheOpen()
    {
        return $this->choopyAtTheOpen;
    }

    /**
     * @param mixed $choopyAtTheOpen
     */
    public function setChoopyAtTheOpen($choopyAtTheOpen)
    {
        $this->choopyAtTheOpen = $choopyAtTheOpen;
    }

    /**
     * @return mixed
     */
    public function getVwapRejection()
    {
        return $this->vwapRejection;
    }

    /**
     * @param mixed $vwapRejection
     */
    public function setVwapRejection($vwapRejection)
    {
        $this->vwapRejection = $vwapRejection;
    }

    /**
     * @return mixed
     */
    public function getVwapRejectionTime()
    {
        return $this->vwapRejectionTime;
    }

    /**
     * @param mixed $vwapRejectionTime
     */
    public function setVwapRejectionTime($vwapRejectionTime)
    {
        $this->vwapRejectionTime = $vwapRejectionTime;
    }

    /**
     * @return float
     */
    public function getHi(): float
    {
        return $this->hi;
    }

    /**
     * @param float $hi
     */
    public function setHi(float $hi)
    {
        $this->hi = $hi;
    }

    /**
     * @return \DateTime
     */
    public function getHiTime(): \DateTime
    {
        return $this->hiTime;
    }

    /**
     * @param \DateTime $hiTime
     */
    public function setHiTime(\DateTime $hiTime)
    {
        $this->hiTime = $hiTime;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow(float $low)
    {
        $this->low = $low;
    }

    /**
     * @return \DateTime
     */
    public function getLowTime(): \DateTime
    {
        return $this->lowTime;
    }

    /**
     * @param \DateTime $lowTime
     */
    public function setLowTime(\DateTime $lowTime)
    {
        $this->lowTime = $lowTime;
    }

    /**
     * @return float
     */
    public function getHodBeforeZb(): float
    {
        return $this->hodBeforeZb;
    }

    /**
     * @param float $hodBeforeZb
     */
    public function setHodBeforeZb(float $hodBeforeZb)
    {
        $this->hodBeforeZb = $hodBeforeZb;
    }

    /**
     * @return mixed
     */
    public function getZb()
    {
        return $this->zb;
    }

    /**
     * @param mixed $zb
     */
    public function setZb($zb)
    {
        $this->zb = $zb;
    }

    /**
     * @return \DateTime
     */
    public function getZbTime(): \DateTime
    {
        return $this->zbTime;
    }

    /**
     * @param \DateTime $zbTime
     */
    public function setZbTime(\DateTime $zbTime)
    {
        $this->zbTime = $zbTime;
    }

    /**
     * @return float
     */
    public function getZbHi(): float
    {
        return $this->zbHi;
    }

    /**
     * @param float $zbHi
     */
    public function setZbHi(float $zbHi)
    {
        $this->zbHi = $zbHi;
    }

    /**
     * @return float
     */
    public function getZbHiToHOD(): float
    {
        return $this->zbHiToHOD;
    }

    /**
     * @param float $zbHiToHOD
     */
    public function setZbHiToHOD(float $zbHiToHOD)
    {
        $this->zbHiToHOD = $zbHiToHOD;
    }

    /**
     * @return mixed
     */
    public function getAdf()
    {
        return $this->adf;
    }

    /**
     * @param mixed $adf
     */
    public function setAdf($adf)
    {
        $this->adf = $adf;
    }

    /**
     * @return mixed
     */
    public function getChannelT()
    {
        return $this->channelT;
    }

    /**
     * @param mixed $channelT
     */
    public function setChannelT($channelT)
    {
        $this->channelT = $channelT;
    }

    /**
     * @return mixed
     */
    public function getEodBreakdown()
    {
        return $this->eodBreakdown;
    }

    /**
     * @param mixed $eodBreakdown
     */
    public function setEodBreakdown($eodBreakdown)
    {
        $this->eodBreakdown = $eodBreakdown;
    }

    /**
     * @return mixed
     */
    public function getEodSqueeze()
    {
        return $this->eodSqueeze;
    }

    /**
     * @param mixed $eodSqueeze
     */
    public function setEodSqueeze($eodSqueeze)
    {
        $this->eodSqueeze = $eodSqueeze;
    }

    /**
     * @return \DateTime
     */
    public function getSqueezeTime(): \DateTime
    {
        return $this->squeezeTime;
    }

    /**
     * @param \DateTime $squeezeTime
     */
    public function setSqueezeTime(\DateTime $squeezeTime)
    {
        $this->squeezeTime = $squeezeTime;
    }

    /**
     * @return mixed
     */
    public function getAboveVwap330()
    {
        return $this->aboveVwap330;
    }

    /**
     * @param mixed $aboveVwap330
     */
    public function setAboveVwap330($aboveVwap330)
    {
        $this->aboveVwap330 = $aboveVwap330;
    }

    /**
     * @return mixed
     */
    public function getChartLink()
    {
        return $this->chartLink;
    }

    /**
     * @param mixed $chartLink
     */
    public function setChartLink($chartLink)
    {
        $this->chartLink = $chartLink;
    }

    /**
     * @param TickerPerformance $tickerPerformance
     */
    public function setTickerPerformance(TickerPerformance $tickerPerformance)
    {
        $this->tickerPerformance = $tickerPerformance;
    }

    public function getTickerPerformance(): ?TickerPerformance
    {
        return $this->tickerPerformance;
    }
}