<?php

namespace App\Repository;

use App\Entity\TeaProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TeaProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeaProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeaProduct[]    findAll()
 * @method TeaProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeaProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TeaProduct::class);
    }

    // /**
    //  * @return TeaProduct[] Returns an array of TeaProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeaProduct
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
