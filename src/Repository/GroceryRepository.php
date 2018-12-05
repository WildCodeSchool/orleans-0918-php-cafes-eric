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
}
