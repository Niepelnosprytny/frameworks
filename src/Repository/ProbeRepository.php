<?php

namespace App\Repository;

use App\Entity\Probe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Probe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Probe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Probe[]    findAll()
 * @method Probe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProbeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Probe::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Probe $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Probe $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllDisabledProbes()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT probe.id
        FROM probe,vote,user
        WHERE (user.id = vote.user_id
        AND probe.id = vote.question_id)
        AND enabled = false
        GROUP BY probe.id';

        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    public function findAllAlreadyVotedByUserProbes(int $userId)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT probe.id
        FROM probe,vote,user
        WHERE (user.id = vote.user_id
        AND probe.id = vote.question_id)
        AND user.id = :user';

        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery(['user' => $userId]);

        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Probe[] Returns an array of Probe objects
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
    public function findOneBySomeField($value): ?Probe
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
