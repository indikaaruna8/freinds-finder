<?php

namespace In\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use In\Entity\AdminProfile;

/**
 * @extends ServiceEntityRepository<AdminProfile>
 *
 * @method AdminProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdminProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdminProfile[]    findAll()
 * @method AdminProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdminProfile::class);
    }

    public function add(AdminProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AdminProfile $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AdminProfile[] Returns an array of AdminProfile objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AdminProfile
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
