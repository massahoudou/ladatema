<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    private $paginator;

    public function __construct(ManagerRegistry $registry,PaginatorInterface $paginator)
    {
        parent::__construct($registry, Offre::class);
        $this->paginator = $paginator;
    }
    public function counter()
    {
       return $query = $this->createQueryBuilder('o')
                            ->select('count(o.id) AS count')
                         ->getQuery()
                        ->getOneOrNullResult();
    }

    public function OffreRecent()
    {
        return $this->createQueryBuilder('o')
                    ->setMaxResults('10')
                    ->orderBy('o.id','DESC')
                    ->getQuery()
                    ->getResult()
            ;
    }
    public function findOffreRecruteur ( $value)
    {
        $query = $this->createQueryBuilder('o')
                    ->Where('o.recruteur= :value')
                    ->setParameter('value',$value)
                    ->getQuery()
                    ->getResult()
            ;
        return $query;
    }
    public function findRelatif($value)
    {
        return $this->createQueryBuilder('o')
                    ->join('o.secteur','s')
                    ->andWhere('s IN ('.$value.')')
                    ->getQuery()
                    ->getResult()
           ;
    }
    public function findLatest()
    {
        return $this->createQueryBuilder('o')
            ->setMaxResults('6')
            ->orderBy('o.id','DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    /**
     * @Return PaginatorInterface
     */
    public function findSearch(SearchData $searchData): \Knp\Component\Pager\Pagination\PaginationInterface
    {

         $query = $this->getSearchData($searchData)->getQuery();
        return $this->paginator->paginate(
            $query,
            $searchData->page,
            9
        );
    }

    /**
     * @var integer[]
     *
     */
    public function findminmax(SearchData  $searchData): array
    {
        $resultat = $this->getSearchData($searchData , true)
            ->select('MIN(o.salaire) as min', 'Max(o.salaire) as max' )
            ->getQuery()
            ->getScalarResult();
        return [ (int) $resultat[0]['min'], (int) $resultat[0]['max']]  ;
    }
    private function getSearchData( SearchData  $searchData,$ignoresalaire = false):QueryBuilder
    {
        $query = $this
            ->createQueryBuilder('o')
            ->select( 'o','s')
            ->join('o.secteur','s')
            ->join('o.catcontrat','c');

        if (!empty($searchData->q))
        {
            $query = $query
                ->andWhere('o.titre LIKE :q')
                ->setParameter('q', "%{$searchData->q}%");
        }
        if (!empty($searchData->categorie))
        {
            $query = $query
                ->andWhere('c.id IN (:cat)')
                ->setParameter('cat', $searchData->categorie);
        }
        if (!empty($searchData->secteur))
        {
            $query = $query
                ->andWhere('s.id IN (:sect)')
                ->setParameter('sect', $searchData->secteur);
        }
        if(!empty($searchData->pays))
        {
            $query = $query
                ->andWhere('o.pays LIKE :pays')
                ->setParameter('pays', "{$searchData->pays}%" );
        }
        if(!empty($searchData->min) && $ignoresalaire === false)
        {
            $query = $query
                ->andWhere('o.salaire >= :min')
                ->setParameter('min',$searchData->min);
        }
        if(!empty($searchData->max) && $ignoresalaire === false)
        {
            $query = $query
                ->andWhere('o.salaire <= :max')
                ->setParameter('max',$searchData->max);
        }

        return $query;
        // if(!empty($searchData->etud))
        // {
        //     $query = $query
        //             ->andWhere('o.id IN  ' );
        // }
    }

    // /**
    //  * @return Offre[] Returns an array of Offre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
