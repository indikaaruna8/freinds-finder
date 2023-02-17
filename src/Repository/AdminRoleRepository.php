<?php

namespace In\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use In\Entity\AdminRole;
use Lib\In\ListBundle\Interfaces\SearchRepositoryInterface;
use Lib\In\ListBundle\Interfaces\QueryBuilderInterface as QBI;

/**
 * @extends ServiceEntityRepository<AdminRole>
 *
 * @method AdminRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminRole[]    findAll()
 * @method AdminRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRoleRepository extends ServiceEntityRepository //implements SearchRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminRole::class);
    }

    public function add(AdminRole $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AdminRole $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    public function search(QBI $filter)
//    {
//
//    }
//
//    public function seachCount(QBI $filter)
//    {
//
//    }

//    /**
//     * @return AdminRole[] Returns an array of AdminRole objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AdminRole
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
