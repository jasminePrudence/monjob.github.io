<?php

namespace App\Repository;

use App\Entity\TypeNom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeNom|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeNom|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeNom[]    findAll()
 * @method TypeNom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeNomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeNom::class);
    }

    // /**
    //  * @return TypeNom[] Returns an array of TypeNom objects
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
    public function findOneBySomeField($value): ?TypeNom
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
