<?php

namespace App\Repository;

use App\Entity\FamilyTea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FamilyTea|null find($id, $lockMode = null, $lockVersion = null)
 * @method FamilyTea|null findOneBy(array $criteria, array $orderBy = null)
 * @method FamilyTea[]    findAll()
 * @method FamilyTea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FamilyTeaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FamilyTea::class);
    }

    // /**
    //  * @return FamilyTea[] Returns an array of FamilyTea objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FamilyTea
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
