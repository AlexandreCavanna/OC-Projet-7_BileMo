<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getPaginatedUsers(Request $request)
    {
        $query = $this->createQueryBuilder('u');
        $limit = $request->query->get('limit');
        $offset = $request->query->get('offset') ?? 1;

        $query
            ->select('u')
            ->where('u.customer ='.$request->attributes->get('id'))
            ->setFirstResult(($offset * $limit) - $limit)
            ->orderBy('u.createdAt', 'DESC')
            ->setMaxResults($limit)
        ;
        return $query->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
