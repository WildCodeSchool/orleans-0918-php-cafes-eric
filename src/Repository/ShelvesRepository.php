<?php

namespace App\Repository;

use App\Entity\Shelves;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Shelves|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shelves|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shelves[]    findAll()
 * @method Shelves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShelvesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Shelves::class);
    }

    // /**
    //  * @return Shelves[] Returns an array of Shelves objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Shelves
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
