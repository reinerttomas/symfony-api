<?php

namespace App\Repository;

use App\Entity\User;
use App\Exception\Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function get(int $id): User
    {
        $entity = $this->find($id);

        if ($entity === null) {
            throw new Exception('User not found. ID: ' . $id);
        }

        return $entity;
    }

    public function getByEmail(string $email): User
    {
        $entity = $this->findByEmail($email);

        if ($entity === null) {
            throw new Exception('User not found. Email: ' . $email);
        }

        return $entity;
    }

    public function findByEmail(string $email): ?User
    {
        $qb = $this->createQueryBuilder('u');

        $qb->where($qb->expr()->eq('u.email', ':email'))
            ->setParameter('email', $email);

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function store(User $entity): User
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        $em->flush();

        return $entity;
    }
}
