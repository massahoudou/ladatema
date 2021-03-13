<?php

namespace App\Repository;

use App\Entity\Apropos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Apropos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apropos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apropos[]    findAll()
 * @method Apropos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AproposRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Apropos::class);
    }
    public function cocherRh()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.type  = \'rh\'')
            ->andWhere('a.afficher  =  true ')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function cocherfinnace()
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.type  = \'finance\'')
            ->andWhere('a.afficher  =  true ')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function findOne()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->setMaxResults('1')
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
    public  function findRh()
    {
       $query =  $this->createQueryBuilder('a')
                    ->where('a.afficher = true ')
                    ->andWhere('a.type = :value' )
                    ->setParameter('value', 'rh')
                    ->orderBy('a.id','ASC')
                    ->setMaxResults(1)
                    ->getQuery()
                    ->getResult();
        return $query ;

    }

    // /**
    //  * @return Apropos[] Returns an array of Apropos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Apropos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
