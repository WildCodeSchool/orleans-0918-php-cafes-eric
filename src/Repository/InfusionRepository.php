<?php

namespace App\Repository;

use App\Entity\Infusion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Infusion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infusion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infusion[]    findAll()
 * @method Infusion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfusionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Infusion::class);
    }
}
