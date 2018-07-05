<?php

namespace App\Repository;

use App\Entity\Bars;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Bars|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bars|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bars[]    findAll()
 * @method Bars[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BarsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Bars::class);
    }

    public function findBarsWithKeyWord($key_word)
    {

        $req = $this->createQueryBuilder('b')
            ->andWhere('b.nom LIKE :key_word')
            ->andWhere('b.Alcools LIKE :key_word')
            ->andWhere('b.Adresse LIKE :key_word')
            ->setParameter('key_word', '%'.$key_word.'%')
            ->getQuery();

            return $req->getResult();
    }

//    /**
//     * @return Bars[] Returns an array of Bars objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bars
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
