<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/20/21
 * Time: 10:06 PM
 */

namespace App\Repository;

use App\Entity\Ticker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TickerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticker::class);
    }
}