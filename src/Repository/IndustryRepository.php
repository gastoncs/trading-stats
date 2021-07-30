<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/20/21
 * Time: 10:06 PM
 */

namespace App\Repository;

use App\Entity\Industry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IndustryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Industry::class);
    }
}