<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/22/21
 * Time: 11:02 PM
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TickerAverageRepository")
 * @ORM\Table(name="ticker_average")
 */
class TickerAverage
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
     * @var integer
     *
     * @ORM\Column(type="smallint", length=1, nullable=true)
     */
    private $dayGap;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgVolume;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgGap;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgEod;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgOtoh;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgOtohGreater0;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgOtol;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgOtolLower0;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $avgRange;


    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $eodGreater0;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", scale=2, precision=11, nullable=true)
     */
    private $eodLess0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $eodCount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $updated;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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

    /**
     * @return float
     */
    public function getAvgVolume(): float
    {
        return $this->avgVolume;
    }

    /**
     * @param float $avgVolume
     */
    public function setAvgVolume(float $avgVolume)
    {
        $this->avgVolume = $avgVolume;
    }

    /**
     * @return float
     */
    public function getAvgGap(): float
    {
        return $this->avgGap;
    }

    /**
     * @param float $avgGap
     */
    public function setAvgGap(float $avgGap)
    {
        $this->avgGap = $avgGap;
    }

    /**
     * @return float
     */
    public function getAvgEod(): float
    {
        return $this->avgEod;
    }

    /**
     * @param float $avgEod
     */
    public function setAvgEod(float $avgEod)
    {
        $this->avgEod = $avgEod;
    }

    /**
     * @return float
     */
    public function getAvgOtoh(): float
    {
        return $this->avgOtoh;
    }

    /**
     * @param float $avgOtoh
     */
    public function setAvgOtoh(float $avgOtoh)
    {
        $this->avgOtoh = $avgOtoh;
    }

    /**
     * @return float
     */
    public function getAvgOtohGreater0(): float
    {
        return $this->avgOtohGreater0;
    }

    /**
     * @param float $avgOtohGreater0
     */
    public function setAvgOtohGreater0(float $avgOtohGreater0)
    {
        $this->avgOtohGreater0 = $avgOtohGreater0;
    }

    /**
     * @return float
     */
    public function getAvgOtol(): float
    {
        return $this->avgOtol;
    }

    /**
     * @param float $avgOtol
     */
    public function setAvgOtol(float $avgOtol)
    {
        $this->avgOtol = $avgOtol;
    }

    /**
     * @return float
     */
    public function getAvgOtolLower0(): float
    {
        return $this->avgOtolLower0;
    }

    /**
     * @param float $avgOtolLower0
     */
    public function setAvgOtolLower0(float $avgOtolLower0)
    {
        $this->avgOtolLower0 = $avgOtolLower0;
    }

    /**
     * @return float
     */
    public function getAvgRange(): float
    {
        return $this->avgRange;
    }

    /**
     * @param float $avgRange
     */
    public function setAvgRange(float $avgRange)
    {
        $this->avgRange = $avgRange;
    }

    /**
     * @return float
     */
    public function getEodGreater0(): float
    {
        return $this->eodGreater0;
    }

    /**
     * @param float $eodGreater0
     */
    public function setEodGreater0(float $eodGreater0)
    {
        $this->eodGreater0 = $eodGreater0;
    }

    /**
     * @return float
     */
    public function getEodLess0(): float
    {
        return $this->eodLess0;
    }

    /**
     * @param float $eodLess0
     */
    public function setEodLess0(float $eodLess0)
    {
        $this->eodLess0 = $eodLess0;
    }

    /**
     * @return int
     */
    public function getEodCount(): int
    {
        return $this->eodCount;
    }

    /**
     * @param int $eodCount
     */
    public function setEodCount(int $eodCount)
    {
        $this->eodCount = $eodCount;
    }

    /**
     * @return \DateTime
     */
    public function getUpdated(): \DateTime
    {
        return $this->updated;
    }

    /**
     * @param \DateTime $updated
     */
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): string
    {
        // This entity implements JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
        // so this method is used to customize its JSON representation when json_encode()
        // is called, for example in tags|json_encode (templates/form/fields.html.twig)

        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }

}