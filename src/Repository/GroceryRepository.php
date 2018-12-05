<?php

namespace App\Repository;

use App\Entity\Grocery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Grocery|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grocery|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grocery[]    findAll()
 * @method Grocery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroceryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Grocery::class);
    }

    // /**
    //  * @return Grocery[] Returns an array of Grocery objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grocery
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
