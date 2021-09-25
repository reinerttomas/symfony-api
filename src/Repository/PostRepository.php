<?php

namespace App\Repository;

use App\Entity\Post;
use App\Exception\NotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Post>
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }

    public function get(int $id): Post
    {
        $entity = $this->find($id);

        if ($entity === null) {
            throw new NotFoundException('Post not found. ID: ' . $id);
        }

        return $entity;
    }

    public function getBySlug(string $slug): Post
    {
        $entity = $this->findBySlug($slug);

        if ($entity === null) {
            throw new NotFoundException('Post not found. Slug: ' . $slug);
        }

        return $entity;
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->findOneBy(
            [
                'slug' => $slug
            ]
        );
    }

    public function store(Post $entity): Post
    {
        $em = $this->getEntityManager();

        $em->persist($entity);
        $em->flush();

        return $entity;
    }
}
