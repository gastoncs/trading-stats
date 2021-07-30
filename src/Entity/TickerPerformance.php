<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TickerPerformanceRepository")
 * @ORM\Table(name="ticker_performance")
 */
class TickerPerformance
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Ticker", inversedBy="tickerPerformances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ticker;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", scale=2, precision=11, nullable=false)
     * @Assert\NotBlank
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11,nullable=false)
     * @Assert\NotBlank
     */
    private $open;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=false)
     * @Assert\NotBlank
     */
    private $hi;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=false)
     * @Assert\NotBlank
     */
    private $low;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=false)
     * @Assert\NotBlank
     */
    private $close;

    /**
     * @var float
     *
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\NotBlank
     */
    private $volume;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11)
     */
    private $gap;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="end_of_day", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $eod;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="open_to_high", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $otoh;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="open_to_low", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $otol;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="range_in_price", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $rangeInPrice;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $atr;

    /**
     * @var float
     *
     * @ORM\Column(type="integer", name="share_float")
     * @Assert\NotBlank
     */
    private $shareFloat;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="short_float", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $shortFloat;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="insiders_own", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $insidersOwn;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="institution_own", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $institutionOwn;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     */
    private $dilution;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", name="market_cap")
     * @Assert\NotBlank
     */
    private $marketCap;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *     min=5,
     *     minMessage="comment.too_short",
     *     max=10000,
     *     maxMessage="comment.too_long"
     * )
     */
    private $news;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $etb;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $ssr;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="float_rotation", scale=2, precision=11)
     */
    private $floatRotation;

    /**
     * @var Sector
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Sector")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sector;

    /**
     * @var Industry
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Industry")
     * @ORM\JoinColumn(nullable=true)
     */
    private $industry;

    /**
     * @var DailyPrediction[]|Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="DailyPrediction",
     *      mappedBy="dailyPredictions",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     * @ORM\OrderBy({"date": "DESC"})
     */
    private $dailyPredictions;

    /**
     * @var TickerSetupPerformance[]|Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="TickerSetupPerformance",
     *      mappedBy="tickerSetupPerformances",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     * @ORM\OrderBy({"date": "DESC"})
     */
    private $tickerSetupPerformances;

    /**
     * @var integer
     *
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $dayGap;


    public function __construct()
    {
        $this->dailyPredictions = new ArrayCollection();
        $this->tickerSetupPerformances = new ArrayCollection();
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
     * @param $ticker
     */
    public function setTicker(Ticker $ticker)
    {
        $this->ticker = $ticker;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getOpen(): float
    {
        return $this->open;
    }

    /**
     * @param float $open
     */
    public function setOpen(float $open)
    {
        $this->open = $open;
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
     * @return float
     */
    public function getClose(): float
    {
        return $this->close;
    }

    /**
     * @param float $close
     */
    public function setClose(float $close)
    {
        $this->close = $close;
    }

    /**
     * @return int
     */
    public function getVolume(): int
    {
        return $this->volume;
    }

    /**
     * @param int $volume
     */
    public function setVolume(int $volume)
    {

        $this->volume = $volume;
    }

    /**
     * @return float
     */
    public function getGap(): float
    {
        return $this->gap;
    }

    /**
     * @param float $gap
     */
    public function setGap(float $gap)
    {
        $this->gap = $gap;
    }

    /**
     * @param float $eod
     */
    public function setEod(float $eod)
    {
        $this->eod = $eod;
    }

    /**
     * End of the day
     *
     * @return float
     */
    public function getEod(): float
    {
        return $this->eod;
    }

    /**
     * @param float $otoh
     */
    public function setOtoh(float $otoh)
    {
        $this->otoh = $otoh;
    }

    /**
     * @return float
     */
    public function getOtoh(): float
    {
        return $this->otoh;
    }

    /**
     * @param float $otol
     */
    public function setOtol(float $otol)
    {
        $this->otol = $otol;
    }

    /**
     * @return float
     */
    public function getOtol(): float
    {
        return $this->otol;
    }

    /**
     * @param float $rangeInPrice
     */
    public function setRangeInPrice(float $rangeInPrice)
    {
        $this->rangeInPrice = $rangeInPrice;
    }

    /**
     * @return float
     */
    public function getRangeInPrice(): float
    {
        return $this->rangeInPrice;
    }

    /**
     * @return float
     */
    public function getAtr(): float
    {
        return $this->atr;
    }

    /**
     * @param float $atr
     */
    public function setAtr(float $atr)
    {
        $this->atr = $atr;
    }

    /**
     * @return float
     */
    public function getShareFloat(): float
    {
        return $this->shareFloat;
    }

    /**
     * @param float $shareFloat
     */
    public function setShareFloat(float $shareFloat)
    {
        $this->shareFloat = $shareFloat;
    }


    /**
     * @return float
     */
    public function getShortFloat(): float
    {
        return $this->shortFloat;
    }

    /**
     * @param float $shortFloat
     */
    public function setShortFloat(float $shortFloat)
    {
        $this->shortFloat = $shortFloat;
    }

    /**
     * @return float
     */
    public function getInsidersOwn(): float
    {
        return $this->insidersOwn;
    }

    /**
     * @param float $insidersOwn
     */
    public function setInsidersOwn(float $insidersOwn)
    {
        $this->insidersOwn = $insidersOwn;
    }

    /**
     * @return float
     */
    public function getInstitutionOwn(): float
    {
        return $this->institutionOwn;
    }

    /**
     * @param float $institutionOwn
     */
    public function setInstitutionOwn(float $institutionOwn)
    {
        $this->institutionOwn = $institutionOwn;
    }

    /**
     * @return string
     */
    public function getDilution(): string
    {
        return $this->dilution;
    }

    /**
     * @param string $dilution
     */
    public function setDilution(string $dilution)
    {
        $this->dilution = $dilution;
    }

    /**
     * @return int
     */
    public function getMarketCap(): int
    {
        return $this->marketCap;
    }

    /**
     * @param int $marketCap
     */
    public function setMarketCap(int $marketCap)
    {
        $this->marketCap = $marketCap;
    }

    /**
     * @return mixed
     */
    public function getNews()
    {
        return $this->news;
    }

    /**
     * @param mixed $news
     */
    public function setNews($news)
    {
        $this->news = $news;
    }

    /**
     * @return mixed
     */
    public function getEtb()
    {
        return $this->etb;
    }

    /**
     * @param mixed $etb
     */
    public function setEtb($etb)
    {
        $this->etb = $etb;
    }

    /**
     * @return string
     */
    public function getSsr(): string
    {
        return $this->ssr;
    }

    /**
     * @param string $ssr
     */
    public function setSsr(string $ssr)
    {
        $this->ssr = $ssr;
    }

    /**
     * @return float
     */
    public function getFloatRotation(): float
    {
        return $this->floatRotation;
    }

    /**
     * @param float $floatRotation
     */
    public function setFloatRotation(float $floatRotation)
    {
        $this->floatRotation = $floatRotation;
    }

    /**
     * @return Sector
     */
    public function getSector(): Sector
    {
        return $this->sector;
    }

    /**
     * @param Sector $sector
     */
    public function setSector(Sector $sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return Industry
     */
    public function getIndustry(): Industry
    {
        return $this->industry;
    }

    /**
     * @param Industry $industry
     */
    public function setIndustry(Industry $industry)
    {
        $this->industry = $industry;
    }

    public function getDailyPredictions(): Collection
    {
        return $this->dailyPredictions;
    }

    /**
     * @return int
     */
    public function getDayGap(): int
    {
        return $this->dayGap;
    }

    /**
     * @param int $dayGap
     */
    public function setDayGap(int $dayGap)
    {
        $this->dayGap = $dayGap;
    }

    public function addDailyPrediction(DailyPrediction $dailyPrediction): void
    {
        $dailyPrediction->setTickerPerformance($this);

        if (!$this->dailyPredictions->contains($dailyPrediction)) {
            $this->dailyPredictions->add($dailyPrediction);
        }
    }

    public function removeDailyPrediction(DailyPrediction $dailyPrediction): void
    {
        $this->dailyPredictions->removeElement($dailyPrediction);
    }

    public function getTickerSetupPerfomances(): Collection
    {
        return $this->tickerSetupPerformances;
    }

    public function addTickerSetupPerfomance(TickerSetupPerformance $tickerSetupPerformance): void
    {
        $tickerSetupPerformance->setTickerPerformance($this);

        if (!$this->tickerSetupPerformances->contains($tickerSetupPerformance)) {
            $this->tickerSetupPerformances->add($tickerSetupPerformance);
        }
    }

    public function removeTickerSetupPerfomance(TickerSetupPerformance $tickerSetupPerformance): void
    {
        $this->tickerSetupPerformances->removeElement($tickerSetupPerformance);
    }
}
