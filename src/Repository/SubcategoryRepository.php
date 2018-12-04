<?php

namespace App\Repository;

use App\Entity\Subcategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Subcategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subcategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subcategory[]    findAll()
 * @method Subcategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubcategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Subcategory::class);
    }
}