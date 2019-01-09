<?php

namespace App\Repository;

use App\Entity\FamilyInfusion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FamilyInfusion|null find($id, $lockMode = null, $lockVersion = null)
 * @method FamilyInfusion|null findOneBy(array $criteria, array $orderBy = null)
 * @method FamilyInfusion[]    findAll()
 * @method FamilyInfusion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilyInfusionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FamilyInfusion::class);
    }
}
