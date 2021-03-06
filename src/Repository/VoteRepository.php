<?php

namespace App\Repository;

use App\Entity\Vote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vote[]    findAll()
 * @method Vote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vote::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Vote $entity, bool $flush = true): void
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
    public function remove(Vote $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findAllVotesPerAnswer(int $probeId, int $answer)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT count(chosen_answer)
        FROM vote, probe, user
        WHERE (vote.user_id = user.id
        AND vote.question_id = probe.id)
        AND probe.id = :probe
        AND chosen_answer = :answer;';
        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery(['probe' => $probeId, 'answer' => $answer]);

        return $resultSet->fetchAllNumeric();
    }

    public function findAllUsersPerProbe(int $probeId){

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT username
        FROM user, vote, probe
        WHERE (user.id = vote.user_id
        AND probe.id = vote.question_id)
        AND probe.id = :probe
        GROUP BY username';

        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery(['probe' => $probeId]);

        return $resultSet->fetchAllAssociative();
    }

    // /**
    //  * @return Vote[] Returns an array of Vote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vote
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
