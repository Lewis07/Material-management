<?php

namespace App\Repository;

use App\Entity\Detenteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Detenteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detenteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detenteur[]    findAll()
 * @method Detenteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetenteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detenteur::class);
    }

    // /**
    //  * @return Detenteur[] Returns an array of Detenteur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Detenteur
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
