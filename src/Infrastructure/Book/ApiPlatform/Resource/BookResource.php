<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\Resource;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Book\Model\Book;
use App\Infrastructure\Book\ApiPlatform\Payload\BookPayload;
use App\Infrastructure\Book\ApiPlatform\View\BookView;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Book',
    input: BookPayload::class,
    output: BookView::class,
    itemOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['item']],
        ],
        'put' => [
            'normalization_context' => ['groups' => ['item']],
            'denormalization_context' => ['groups' => ['update']],
        ],
    ],
    collectionOperations: [
        'get' => [
            'normalization_context' => ['groups' => ['list']],
        ],
        'post' => [
            'normalization_context' => ['groups' => ['item']],
            'denormalization_context' => ['groups' => ['create']],
        ],
    ]
)]
final class BookResource
{
    #[Assert\Positive]
    public ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Isbn]
    public string $isbn;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public string $title;

    #[Assert\NotBlank]
    #[Assert\Length(max: 65534)]
    public string $description;

    #[Assert\NotBlank]
    public string $author;

    public \DateTimeInterface $publicationDate;

    public static function fromModel(Book $model): self
    {
        $resource = new self();

        $resource->id = $model->getId();
        $resource->isbn = $model->getIsbn();
        $resource->title = $model->getTitle();
        $resource->description = $model->getDescription();
        $resource->author = $model->getAuthor();
        $resource->publicationDate = $model->getPublicationDate();

        return $resource;
    }
}
