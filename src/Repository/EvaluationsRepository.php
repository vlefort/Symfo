<?php

namespace App\Repository;

use App\Entity\Evaluations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use PhpParser\Node\Scalar\String_;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Evaluations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evaluations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evaluations[]    findAll()
 * @method Evaluations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Evaluations::class);
    }

    public function findAllAverageEvaluation($Bar)
    {
        $req = $this->createQueryBuilder('i')
            ->select("avg(i.Value)")
            ->Where('i.Bar = :Bar')
            ->setParameter('Bar', $Bar)
            ->getQuery();

        return $req->getSingleScalarResult();
    }

    public function findEvaluations($User, $Bar)
    {
        $req = $this->createQueryBuilder('i')
            ->select("i")
            ->Where('i.User = :User')
            ->andWhere('i.Bar = :Bar')
            ->setParameter('User', $User)
            ->setParameter('Bar' , $Bar)
            ->getQuery();

        return $req->getOneOrNullResult();
    }


//    /**
//     * @return Evaluations[] Returns an array of Evaluations objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Evaluations
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
