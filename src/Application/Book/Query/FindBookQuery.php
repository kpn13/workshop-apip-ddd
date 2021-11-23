<?php

declare(strict_types=1);

namespace App\Application\Book\Query;

use App\Application\Shared\Query\QueryInterface;

final class FindBookQuery implements QueryInterface
{
    public function __construct(public string $id)
    {
    }
}
