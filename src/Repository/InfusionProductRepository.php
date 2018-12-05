<?php

namespace App\Repository;

use App\Entity\InfusionProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InfusionProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfusionProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfusionProduct[]    findAll()
 * @method InfusionProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfusionProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InfusionProduct::class);
    }

    // /**
    //  * @return InfusionProduct[] Returns an array of InfusionProduct objects
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
    public function findOneBySomeField($value): ?InfusionProduct
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
