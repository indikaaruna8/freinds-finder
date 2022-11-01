<?php

namespace In\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use In\Entity\AdminPermission;

/**
 * @extends ServiceEntityRepository<AdminPermission>
 *
 * @method AdminPermission|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminPermission|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminPermission[]    findAll()
 * @method AdminPermission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminPermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminPermission::class);
    }

    public function add(AdminPermission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AdminPermission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AdminPermission[] Returns an array of AdminPermission objects
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

//    public function findOneBySomeField($value): ?AdminPermission
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
