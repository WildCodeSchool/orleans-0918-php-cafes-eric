<?php

namespace App\Repository;

use App\Entity\Advertise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advertise|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advertise|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advertise[]    findAll()
 * @method Advertise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertiseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advertise::class);
    }
}
