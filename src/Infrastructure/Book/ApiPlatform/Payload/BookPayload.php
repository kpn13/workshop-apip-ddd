<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\Payload;

use Symfony\Component\Serializer\Annotation\Groups;

final class BookPayload
{
    public function __construct(
        #[Groups('create')]
        public ?string $isbn,
        #[Groups(['create', 'update'])]
        public ?string $title,
        #[Groups(['create', 'update'])]
        public ?string $description,
        #[Groups('create')]
        public ?string $author,
        #[Groups('create')]
        public ?\DateTimeInterface $publicationDate,
    ) {
    }
}
