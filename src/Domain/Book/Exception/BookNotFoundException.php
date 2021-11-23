<?php

declare(strict_types=1);

namespace App\Domain\Book\Exception;

use App\Domain\Shared\Exception\NotFoundException;

final class BookNotFoundException extends NotFoundException
{
}
