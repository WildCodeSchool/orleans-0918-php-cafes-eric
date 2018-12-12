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

    // /**
    //  * @return Infusion[] Returns an array of Infusion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Infusion
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
