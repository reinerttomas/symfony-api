<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public const POST_1 = 'post.1';
    public const POST_2 = 'post.2';

    public function load(ObjectManager $manager): void
    {
        $post1 = $this->createPost(
            'sunt aut facere',
            'john doe',
            'quia et suscipit',
        );

        $post2 = $this->createPost(
            'qui est esse',
            'tomas reinert',
            'est rerum tempore',
        );

        $manager->persist($post1);
        $manager->persist($post2);
        $manager->flush();

        $this->addReference(self::POST_1, $post1);
        $this->addReference(self::POST_2, $post2);
    }

    private function createPost(
        string $title,
        string $author,
        string $content
    ): Post {
        return new Post(
            $title,
            $author,
            $content
        );
    }
}