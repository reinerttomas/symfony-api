<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var User $user1 */
        $user1 = $this->getReference(UserFixtures::USER_1);
        /** @var User $user2 */
        $user2 = $this->getReference(UserFixtures::USER_2);

        $post1 = $this->createPost(
            $user1,
            'Title 1',
            'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        );

        $post2 = $this->createPost(
            $user1,
            'Title 2',
            'Lorem Ipsum has been the industry standard dummy text ever since the 1500s.',
        );

        $post3 = $this->createPost(
            $user1,
            'Title 3',
            'It has survived not only five centuries.',
        );

        $post4 = $this->createPost(
            $user2,
            'Title 4',
            'It was popularised in the 1960.',
        );

        $post5 = $this->createPost(
            $user2,
            'Title 5',
            'Software like Aldus PageMaker including versions of Lorem Ipsum.',
        );

        $manager->persist($post1);
        $manager->persist($post2);
        $manager->persist($post3);
        $manager->persist($post4);
        $manager->persist($post5);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }

    private function createPost(
        User $author,
        string $title,
        string $content
    ): Post {
        return new Post(
            $author,
            $title,
            $content,
        );
    }
}