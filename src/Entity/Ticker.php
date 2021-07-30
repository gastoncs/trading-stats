<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TickerRepository")
 * @ORM\Table(name="ticker")
 */
class Ticker
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
     * @var string
     *
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="comment.blank")
     */
    private $summary;

    /**
     * @var tickerPerformance[]|Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="TickerPerformance",
     *      mappedBy="ticker",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     */
    private $tickerPerformances;

    /**
     * @var TickerOpenToHi
     *
     * @ORM\OneToMany(
     *      targetEntity="TickerOpenToHi",
     *      mappedBy="ticker",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     */
    private $openToHiPercentage;

    /**
     * @var tickerAverage[]|Collection
     *
     * @ORM\OneToMany(
     *      targetEntity="TickerAverage",
     *      mappedBy="ticker",
     *      orphanRemoval=true,
     *      cascade={"persist"}
     * )
     */
    private $tickerAverages;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", scale=2, precision=11)
     * @Assert\NotBlank
     */
    private $updated;


    public function __construct()
    {
        $this->tickerPerformances = new ArrayCollection();
        $this->tickerAverages = new ArrayCollection();
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
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
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
     * @return tickerPerformance[]|Collection
     */
    public function getTickerPerformances(): Collection
    {
        return $this->tickerPerformances;
    }

    public function addTickerPerformance(TickerPerformance $tickerPerformance): void
    {
        $tickerPerformance->setTicker($this);

        if (!$this->tickerPerformances->contains($tickerPerformance)) {
            $this->tickerPerformances->add($tickerPerformance);
        }
    }

    public function removeTickerPerformance(TickerPerformance $tickerPerformance): void
    {
        $this->tickerPerformances->removeElement($tickerPerformance);
    }

    /**
     * @return TickerOpenToHi
     */
    public function getOpenToHiPercentageDay1()
    {
        return $this->openToHiPercentage[0];
    }

    /**
     * @return TickerOpenToHi
     */
    public function getOpenToHiPercentageDay2()
    {
        return $this->openToHiPercentage[1];
    }

    /**
     * @return TickerOpenToHi
     */
    public function getOpenToHiPercentageDay3()
    {
        return $this->openToHiPercentage[2];
    }

    /**
     * @return tickerAverage[]|Collection
     */
    public function getTickerAverages()
    {
        return $this->tickerAverages;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize(): string
    {
        // This entity implements JsonSerializable (http://php.net/manual/en/class.jsonserializable.php)
        // so this method is used to customize its JSON representation when json_encode()
        // is called, for example in tags|json_encode (templates/form/fields.html.twig)

        return $this->code;
    }

    public function __toString(): string
    {
        return $this->code;
    }
}
