<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandInterface;

final class UpdateBookCommand implements CommandInterface
{
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
    ) {
    }
}
