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
 * @ORM\Entity(repositoryClass="App\Repository\OpenToHiProbabilityRepository")
 * @ORM\Table(name="open_to_hi_probability")
 */
class TickerOpenToHiProbability
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
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countFrom0To10;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countF11To20;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countF21To30;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countF31To40;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countF41To50;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countF51To60;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $countF61To70;

    /**
     * @ORM\Column(type="smallint", length=999, nullable=true)
     */
    private $greatterThan70;
}