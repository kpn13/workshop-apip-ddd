<?php

declare(strict_types=1);

namespace App\Domain\Book\Model;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
class Book
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id;

    #[ORM\Column(type: 'string')]
    private string $isbn;

    #[ORM\Column(type: 'string')]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $description;

    #[ORM\Column(type: 'string')]
    private string $author;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $publicationDate;

    public function __construct(
        string $isbn,
        string $title,
        string $description,
        string $author,
        \DateTimeInterface $publicationDate,
    ) {
        $this->id = (string) Uuid::uuid4();
        $this->isbn = $isbn;
        $this->title = $title;
        $this->description = $description;
        $this->author = $author;
        $this->publicationDate = $publicationDate;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getPublicationDate(): \DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function prettify(): void
    {
        $this->title = ucfirst($this->title);
        $this->author = strtoupper($this->author);
    }

    public function changeTitle(string $title): void
    {
        $this->title = $title;
    }

    public function changeDescription(string $description): void
    {
        $this->description = $description;
    }
}
