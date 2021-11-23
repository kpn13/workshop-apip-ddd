<?php

declare(strict_types=1);

namespace App\Application\Book\Query;

use App\Application\Shared\Query\QueryInterface;
use App\Domain\Shared\Criteria\Criteria;

final class FindBooksQuery implements QueryInterface
{
    public function __construct(public Criteria $criteria)
    {
    }
}
