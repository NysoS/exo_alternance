<?php

namespace App\Repository;

use App\Entity\TShirt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TShirt|null find($id, $lockMode = null, $lockVersion = null)
 * @method TShirt|null findOneBy(array $criteria, array $orderBy = null)
 * @method TShirt[]    findAll()
 * @method TShirt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TShirtRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TShirt::class);
    }

    // /**
    //  * @return TShirt[] Returns an array of TShirt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TShirt
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
