<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 6/26/21
 * Time: 2:15 PM
 */

namespace App\Repository;

use App\Entity\Ticker;
use App\Entity\TickerAverage;
use App\Entity\TickerPerformance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

class TickerAverageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TickerAverage::class);
    }

}