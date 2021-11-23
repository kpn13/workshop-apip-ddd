<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\View;

use Symfony\Component\Serializer\Annotation\Groups;

final class BookView
{
    public function __construct(
        #[Groups(['item'])]
        public string $isbn,
        #[Groups(['item', 'list'])]
        public string $title,
        #[Groups(['item'])]
        public string $description,
        #[Groups(['item', 'list'])]
        public string $author,
        #[Groups(['item', 'list'])]
        public \DateTimeInterface $publicationDate,
    ) {
    }
}
