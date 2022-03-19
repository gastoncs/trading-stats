<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/13/21
 * Time: 4:52 PM
 */

namespace App\Repository;

use App\Entity\TickerOpenToHi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OpenToHiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TickerOpenToHi::class);
    }
}