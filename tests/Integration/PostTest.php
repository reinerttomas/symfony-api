<?php
declare(strict_types=1);

namespace App\Tests\Integration;

use App\Repository\PostRepository;
use App\Tests\Integration\Attribute\ContainerTrait;
use App\Utils\DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class PostTest extends KernelTestCase
{
    use ContainerTrait;

    private PostRepository $postRepository;

    protected function setUp(): void
    {
        $container = $this->getContainerForTest();

        $this->postRepository = $container->get(PostRepository::class);
    }

    /**
     * @dataProvider providePostGetData
     */
    public function testGet(
        int $id,
        int $authorId,
        string $title,
        string $slug,
        string $content,
        string $createdAt,
        ?string $updatedAt,
        ?string $publishedAt,
    ): void
    {
        $post = $this->postRepository->get($id);
        
        self::assertEquals($id, $post->getId());
        self::assertEquals($authorId, $post->getAuthor()->getId());
        self::assertEquals($title, $post->getTitle());
        self::assertEquals($slug, $post->getSlug());
        self::assertEquals($content, $post->getContent());
        self::assertEquals($createdAt, $post->getCreatedAt()->toStringDate());
        self::assertEquals($updatedAt, $post->getUpdatedAt()?->toStringDate());
        self::assertEquals($publishedAt, $post->getPublishedAt()?->toStringDate());
    }

    /**
     * @dataProvider providePostGetData
     */
    public function testGetBySlug(
        int $id,
        int $authorId,
        string $title,
        string $slug,
        string $content,
        string $createdAt,
        ?string $updatedAt,
        ?string $publishedAt,
    ): void
    {
        $post = $this->postRepository->getBySlug($slug);

        self::assertEquals($id, $post->getId());
        self::assertEquals($authorId, $post->getAuthor()->getId());
        self::assertEquals($title, $post->getTitle());
        self::assertEquals($slug, $post->getSlug());
        self::assertEquals($content, $post->getContent());
        self::assertEquals($createdAt, $post->getCreatedAt()->toStringDate());
        self::assertEquals($updatedAt, $post->getUpdatedAt()?->toStringDate());
        self::assertEquals($publishedAt, $post->getPublishedAt()?->toStringDate());
    }

    public function providePostGetData(): array
    {
        return [
            [
                'id' => 1,
                'author' => 1,
                'title' => 'Title 1',
                'slug' => 'title-1',
                'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'createdAt' => DateTime::now()->toStringDate(),
                'updatedAt' => null,
                'publishedAt' => null,
            ],
            [
                'id' => 5,
                'author' => 2,
                'title' => 'Title 5',
                'slug' => 'title-5',
                'content' => 'Software like Aldus PageMaker including versions of Lorem Ipsum.',
                'createdAt' => DateTime::now()->toStringDate(),
                'updatedAt' => null,
                'publishedAt' => null,
            ]
        ];
    }
}