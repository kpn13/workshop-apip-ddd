<?php

declare(strict_types=1);

namespace App\Application\Book\Query;

use App\Application\Shared\Query\QueryHandlerInterface;
use App\Domain\Book\Model\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;

final class FindBookQueryHandler implements QueryHandlerInterface
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function __invoke(FindBookQuery $query): ?Book
    {
        return $this->repository->search($query->id);
    }
}
