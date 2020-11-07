<?php

namespace App\Repository;

use App\Entity\Mobilier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Mobilier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mobilier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mobilier[]    findAll()
 * @method Mobilier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobilierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mobilier::class);
    }

    public function comparaisonPrix()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT mobilier.code_mobilier AS mobilier ,mobilier.designation AS designation,
                SUM(entretien.prix) AS prixEntr,
                fournir_mobilier.prix_mobilier AS prixFourMob,
                description_entretien AS description
                FROM mobilier INNER JOIN entretien on mobilier.id=entretien.mobiliers_id 
                INNER join fournir_mobilier on fournir_mobilier.mobiliers_id=mobilier.id 
                GROUP BY mobilier.code_mobilier 
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    

    // /**
    //  * @return Mobilier[] Returns an array of Mobilier objects
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
    public function findOneBySomeField($value): ?Mobilier
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
