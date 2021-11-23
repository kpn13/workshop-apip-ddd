<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandInterface;

final class PrettifyBookCommand implements CommandInterface
{
    public string $id;
}
