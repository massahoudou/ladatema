<?php

namespace App\Repository;

use App\Entity\Catcontrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Catcontrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catcontrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catcontrat[]    findAll()
 * @method Catcontrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatcontratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Catcontrat::class);
    }

    // /**
    //  * @return Catcontrat[] Returns an array of Catcontrat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Catcontrat
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
