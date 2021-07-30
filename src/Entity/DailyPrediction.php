<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DailyPredictionRepository")
 * @ORM\Table(name="daily_prediction")
 */
class DailyPrediction
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
     * @ORM\ManyToOne(targetEntity="App\Entity\TickerPerformance", inversedBy="dailyPredictions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tickerPerformance;

    /**
     * @var Tag[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", cascade={"persist"})
     * @ORM\JoinTable(name="daily_prediction_tag")
     * @ORM\OrderBy({"name": "ASC"})
     * @Assert\Count(max="6", maxMessage="post.too_many_tags")
     */
    private $tags;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="possible_price_hi", scale=2, precision=11)
     */
    private $possiblePriceHi;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="possible_price_low", scale=2, precision=11)
     */
    private $possiblePriceLow;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="real_price_hi", scale=2, precision=11)
     */
    private $realPriceHi;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="real_price_low", scale=2, precision=11)
     */
    private $realPriceLow;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="difference_real_possible_price_hi", scale=2, precision=11)
     */
    private $diffRealPossiblePriceHi;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="difference_real_possible_price_low", scale=2, precision=11)
     */
    private $diffRealPossiblePriceLow;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="accuracy_price_hi_prediction", scale=2, precision=11)
     */
    private $accuracyPriceHiPrediction;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", name="accuracy_price_low_prediction", scale=2, precision=11)
     */
    private $accuracyPriceLowPrediction;

    /**
     * @var Setup
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Setup")
     * @ORM\JoinColumn(nullable=false)
     */
    private $setup;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $notes;

    /**
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $traded;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->datetime = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    public function addTag(Tag ...$tags): void
    {
        foreach ($tags as $tag) {
            if (!$this->tags->contains($tag)) {
                $this->tags->add($tag);
            }
        }
    }

    public function removeTag(Tag $tag): void
    {
        $this->tags->removeElement($tag);
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    /**
     * @return float
     */
    public function getPossiblePriceHi(): float
    {
        return $this->possiblePriceHi;
    }

    /**
     * @return float
     */
    public function getPossiblePriceLow(): float
    {
        return $this->possiblePriceLow;
    }

    /**
     * @param float $possiblePriceLow
     */
    public function setPossiblePriceLow(float $possiblePriceLow)
    {
        $this->possiblePriceLow = $possiblePriceLow;
    }

    /**
     * @return float
     */
    public function getRealPriceHi(): float
    {
        return $this->realPriceHi;
    }

    /**
     * @param float $realPriceHi
     */
    public function setRealPriceHi(float $realPriceHi)
    {
        $this->realPriceHi = $realPriceHi;
    }

    /**
     * @return float
     */
    public function getRealPriceLow(): float
    {
        return $this->realPriceLow;
    }

    /**
     * @param float $realPriceLow
     */
    public function setRealPriceLow(float $realPriceLow)
    {
        $this->realPriceLow = $realPriceLow;
    }

    /**
     * @return float
     */
    public function getDiffRealPossiblePriceHi(): float
    {
        return $this->diffRealPossiblePriceHi;
    }

    /**
     * @param float $diffRealPossiblePriceHi
     */
    public function setDiffRealPossiblePriceHi(float $diffRealPossiblePriceHi)
    {
        $this->diffRealPossiblePriceHi = $diffRealPossiblePriceHi;
    }

    /**
     * @return float
     */
    public function getDiffRealPossiblePriceLow(): float
    {
        return $this->diffRealPossiblePriceLow;
    }

    /**
     * @param float $diffRealPossiblePriceLow
     */
    public function setDiffRealPossiblePriceLow(float $diffRealPossiblePriceLow)
    {
        $this->diffRealPossiblePriceLow = $diffRealPossiblePriceLow;
    }

    /**
     * @return float
     */
    public function getAccuracyPriceHiPrediction(): float
    {
        return $this->accuracyPriceHiPrediction;
    }

    /**
     * @param float $accuracyPriceHiPrediction
     */
    public function setAccuracyPriceHiPrediction(float $accuracyPriceHiPrediction)
    {
        $this->accuracyPriceHiPrediction = $accuracyPriceHiPrediction;
    }

    /**
     * @return float
     */
    public function getAccuracyPriceLowPrediction(): float
    {
        return $this->accuracyPriceLowPrediction;
    }

    /**
     * @param float $accuracyPriceLowPrediction
     */
    public function setAccuracyPriceLowPrediction(float $accuracyPriceLowPrediction)
    {
        $this->accuracyPriceLowPrediction = $accuracyPriceLowPrediction;
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
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getTraded()
    {
        return $this->traded;
    }

    /**
     * @param mixed $traded
     */
    public function setTraded($traded)
    {
        $this->traded = $traded;
    }
}
