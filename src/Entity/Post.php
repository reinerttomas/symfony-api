<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use App\Utils\DateTime;
use App\Utils\Strings;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
#[ApiResource]
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $author;

    /**
     * @ORM\Column(type="text")
     */
    private string $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTime $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTime $publishedAt;
    
    public function __construct(
        string $title,
        string $author,
        string $content,
    ) {
        $this->changeTitle($title);
        $this->author = $author;
        $this->content = $content;
        $this->createdAt = new DateTime();
        $this->updatedAt = null;
        $this->publishedAt = null;
    }
    
    public function getId(): int
    {
        return $this->id;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }

    public function changeTitle(string $title): Post
    {
        $this->title = $title;
        $this->slug = Strings::webalize($title);

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
    
    public function getAuthor(): string
    {
        return $this->author;
    }

    public function changeAuthor(string $author): Post
    {
        $this->author = $author;

        return $this;
    }
    
    public function getContent(): string
    {
        return $this->content;
    }

    public function changeContent(string $content): Post
    {
        $this->content = $content;

        return $this;
    }
    
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function updated(): Post
    {
        $this->updatedAt = new DateTime();

        return $this;
    }
    
    public function getPublishedAt(): ?DateTime
    {
        return $this->publishedAt;
    }

    public function publish(): Post
    {
        $this->publishedAt = new DateTime();

        return $this;
    }
}
