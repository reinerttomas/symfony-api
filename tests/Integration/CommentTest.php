<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use App\Repository\CommentRepository;
use App\Tests\Integration\Attribute\ContainerTrait;
use App\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CommentTest extends KernelTestCase
{
    use ContainerTrait;

    private CommentRepository $commentRepository;

    protected function setUp(): void
    {
        $container = $this->getContainerForTest();

        $this->commentRepository = $container->get(CommentRepository::class);
    }

    /**
     * @dataProvider provideCommentGetData
     */
    public function testGet(
        int $id,
        int $authorId,
        string $content,
        string $createdAt,
        ?string $updatedAt,
    ): void
    {
        $comment = $this->commentRepository->get($id);

        self::assertEquals($id, $comment->getId());
        self::assertEquals($authorId, $comment->getAuthor()->getId());
        self::assertEquals($content, $comment->getContent());
        self::assertEquals($createdAt, $comment->getCreatedAt()->toStringDate());
        self::assertEquals($updatedAt, $comment->getUpdatedAt()?->toStringDate());
    }

    public function provideCommentGetData(): array
    {
        return [
            [
                'id' => 1,
                'authorId' => 1,
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'createdAt' => DateTime::now()->toStringDate(),
                'updatedAt' => null,
            ],
            [
                'id' => 5,
                'authorId' => 2,
                'content' => 'Software like Aldus PageMaker including versions of Lorem Ipsum.',
                'createdAt' => DateTime::now()->toStringDate(),
                'updatedAt' => null,
            ],
        ];
    }
}