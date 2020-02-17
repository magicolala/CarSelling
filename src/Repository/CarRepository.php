<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Car::class);
    }

    // /**
    //  * @return Car[] Returns an array of Car objects
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
    public function findOneBySomeField($value): ?Car
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findBySearch($search)
    {
        return $this->createQueryBuilder('c')
                    ->andWhere('c.brand LIKE :search')
                    ->orWhere('c.model LIKE :search')
                    ->orWhere('c.category LIKE :search')
                    ->setParameter('search', $search)
                    ->getQuery()
                    ->getResult();
    }

    public function findByTerms($terms): Query
    {
        $alias = "c";

        $qb = $this->createQueryBuilder($alias);

        foreach (explode(" ", $terms) as $i => $term) {

            $qb
                ->andWhere($qb->expr()->orX( // nested condition
                    $qb->expr()->like($alias . ".brand", ":term" . $i),
                    $qb->expr()->like($alias . ".model", ":term" . $i),
                    $qb->expr()->like($alias . ".category", ":term" . $i)
                ))
                ->setParameter("term" . $i, "%" . $term . "%")
                ->andWhere('c.isPublished = true');

        }

        return $qb->orderBy('c.brand')->getQuery();
    }

    /**
     * @param $criteria
     * @return Query
     */
    public function findByCriteria($criteria)
    {
        $qb = $this
            ->createQueryBuilder('c');
        if ($criteria['brand'] != '') {
            $qb
                ->andWhere('c.brand = :brand')
                ->setParameter('brand', $criteria['brand']);
        }
        if ($criteria['energie'] != '') {
            $qb
                ->andWhere('c.energie = :energie')
                ->setParameter('energie', $criteria['energie']);
        }
        if ($criteria['category'] != '') {
            $qb
                ->andWhere('c.category = :category')
                ->setParameter('category', $criteria['category']);
        }
        if ($criteria['year'] != '') {
            $qb
                ->andWhere('c.year >= :year')
                ->setParameter('year', $criteria['year']);
        }
        if ($criteria['nbPorte'] != '') {
            $qb
                ->andWhere('c.nbPorte = :nbPorte')
                ->setParameter('nbPorte', $criteria['nbPorte']);
        }
        if ($criteria['boite_de_vitesse'] != '') {
            $qb
                ->andWhere('c.boite_de_vitesse = :boite_de_vitesse')
                ->setParameter('boite_de_vitesse', $criteria['boite_de_vitesse']);
        }
        $qb->andWhere('c.isPublished = true');

        return $qb->orderBy('c.brand')->getQuery();
    }
}
