<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /** @var User $user1 */
        $user1 = $this->getReference(UserFixtures::USER_1);
        /** @var User $user2 */
        $user2 = $this->getReference(UserFixtures::USER_2);

        $comment1 = $this->createComment(
            $user1,
            'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        );

        $comment2 = $this->createComment(
            $user1,
            'Lorem Ipsum has been the industry standard dummy text ever since the 1500s.',
        );

        $comment3 = $this->createComment(
            $user1,
            'It has survived not only five centuries.',
        );

        $comment4 = $this->createComment(
            $user2,
            'It was popularised in the 1960.',
        );

        $comment5 = $this->createComment(
            $user2,
            'Software like Aldus PageMaker including versions of Lorem Ipsum.',
        );

        $manager->persist($comment1);
        $manager->persist($comment2);
        $manager->persist($comment3);
        $manager->persist($comment4);
        $manager->persist($comment5);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }

    private function createComment(
        User $author,
        string $content,
    ): Comment
    {
        return new Comment(
            $author,
            $content,
        );
    }
}