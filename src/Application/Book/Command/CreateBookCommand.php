<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandInterface;

final class CreateBookCommand implements CommandInterface
{
    public function __construct(
        public string $isbn,
        public string $title,
        public string $description,
        public string $author,
        public \DateTimeInterface $publicationDate,
    ) {
    }
}
