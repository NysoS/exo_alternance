<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByFilter(array $filter = null, $prices = null, $size = null, array $search = null){
        $query = $this->createQueryBuilder('p')
                      ->select('p','c')
                      ->innerJoin('p.category','c',Join::WITH,'p.category = c.id');

        foreach($filter as $key=>$value){
            $query->andWhere('p.'.$key. '= :val')->setParameter('val',$value);
        }

        if($prices != null){
            if(array_key_exists(0,$prices)){
                $query->andWhere('p.priceProduct >= :min')->setParameter('min',$prices[0]);
            }
            if(array_key_exists(1,$prices)){
                $query->andWhere('p.priceProduct <= :max')->setParameter('max',$prices[1]);
            }
        }

        if($size != null){
            foreach($size as $key=>$value){
                if($key == 1){
                    $query->andWhere('p.sizes like :val'.$key)->setParameter('val'.$key,'%'.$value.'%');
                }else{
                    $query->orWhere('p.sizes like :val'.$key)->setParameter('val'.$key,'%'.$value.'%');
                }
               
            }
        }

        if($search != null){
            foreach($search as $key => $value){
                $query->orWhere('c.nameCateg like :searchCateg'.$key)->setParameter('searchCateg'.$key,'%'.$value.'%');
                $query->orWhere('p.keyWord like :search'.$key)->setParameter('search'.$key,'%'.$value.'%');
                $query->orWhere('p.nameProduct like :np'.$key.' or p.descProduct like :dp'.$key)->setParameter('np'.$key,$value)->setParameter('dp'.$key,$value);
            }
            $query->addOrderBy('c.nameCateg', 'ASC')
                  ->addOrderBy('p.keyWord', 'ASC');
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
