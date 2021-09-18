<?php
declare(strict_types=1);

namespace App\Tests\Unit;

use App\Entity\Post;
use App\Utils\DateTime;
use PHPUnit\Framework\TestCase;

class PostTest extends TestCase
{
    /**
     * @dataProvider providePostData
     */
    public function testPost(array $expect, array $input): void
    {
        $post = new Post(
            $input['title'],
            $input['author'],
            $input['content'],
        );

        self::assertEquals($expect['title'], $post->getTitle());
        self::assertEquals($expect['slug'], $post->getSlug());
        self::assertEquals($expect['author'], $post->getAuthor());
        self::assertEquals($expect['content'], $post->getContent());
        self::assertEquals($expect['createdAt'], $post->getCreatedAt()->toStringDate());
        self::assertEquals($expect['updatedAt'], $post->getUpdatedAt()?->toStringDate());
        self::assertEquals($expect['publishedAt'], $post->getPublishedAt()?->toStringDate());
    }
    
    public function providePostData(): array
    {
        return [
            [
                [
                    'title' => 'Lorem Ipsum is simply',
                    'slug' => 'lorem-ipsum-is-simply',
                    'author' => 'John Doe',
                    'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                    'createdAt' => DateTime::now()->toStringDate(),
                    'updatedAt' => null,
                    'publishedAt' => null,
                ],
                [
                    'title' => 'Lorem Ipsum is simply',
                    'author' => 'John Doe',
                    'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                ],
            ],
        ];
    }
}