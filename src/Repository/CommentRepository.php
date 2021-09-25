<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }

    public function get(int $id): Comment
    {
        $entity = $this->find($id);

        if ($entity === null) {
            throw new NotFoundException('Comment not found. ID: ' . $id);
        }

        return $entity;
    }

    public function store(Comment $entity): Comment
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        $em->flush();

        return $entity;
    }
}
