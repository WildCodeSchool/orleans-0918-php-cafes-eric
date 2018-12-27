<?php

namespace App\Repository;

use App\Entity\Coffee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Coffee|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coffee|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coffee[]    findAll()
 * @method Coffee[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoffeeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Coffee::class);
    }

    public function listBy(): array
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.category', 'ASC')
            ->getQuery();

        return $qb->execute();
    }
}