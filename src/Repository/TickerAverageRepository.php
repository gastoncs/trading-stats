<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 6/26/21
 * Time: 2:15 PM
 */

namespace App\Repository;

use App\Entity\Ticker;
use App\Entity\TickerPerformance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

class TickerPerformanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TickerPerformance::class);
    }

    public function findGapGreaterThan20ByTicker(Ticker $ticker)
    {
        $criteria = new Criteria();

        $criteria->where($criteria->expr()->gt('gap', .1999));
        $criteria->andWhere($criteria->expr()->eq('ticker', $ticker));
        $criteria->orderBy(array("date" => Criteria::DESC));
        return $this->matching($criteria);
    }
}