<?php

namespace App\Repository;

use App\Entity\Capsule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Capsule>
 *
 * @method Capsule|null find($id, $lockMode = null, $lockVersion = null)
 * @method Capsule|null findOneBy(array $criteria, array $orderBy = null)
 */
class CapsuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Capsule::class);
    }

    public function findBySearchQuery(?string $query): array
    {
        return $this->createQueryBuilder('c')
            ->orWhere('c.producteur LIKE :query')
            ->orWhere('c.couleur LIKE :query')
            ->orWhere('c.inscription LIKE :query')
            ->orWhere('c.decoration LIKE :query')
            ->orWhere('c.lieu LIKE :query')
            ->orWhere('c.taille LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('c.producteur', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
