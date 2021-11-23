<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandInterface;

final class DeleteBookCommand implements CommandInterface
{
    public function __construct(public string $id)
    {
    }
}
