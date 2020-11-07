<?php

namespace App\Repository;

use App\Entity\Materiel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Materiel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Materiel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Materiel[]    findAll()
 * @method Materiel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaterielRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Materiel::class);
    }

    // /**
    //  * @return Materiel[] Returns an array of Materiel objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    
    */

    /*
    public function findOneBySomeField($value): ?Materiel
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    // /**
    //  * @return Materiel[] Returns an array of Materiel objects
    //  */
    // public function materielEnService()
    // {
    //     return $this->createQueryBuilder('m')
    //         ->andWhere('m.service = true AND ')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }

    // public function optionCategorie()
    // {
    //     return $this->createQueryBuilder('m')

    //         // m.categorieMateriel se refère au propriété "categorieMateriel" sur l'entité materiel
    //         ->innerJoin('m.categorieMateriel', 'c')

    //         // selects all the category data to avoid the query
    //         ->addSelect('c.id','c.libelleCateg')
    //         // ->addSelect('c.*')

    //         // par ordre croissant
    //         ->orderBy('m.id', 'ASC')
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
}
