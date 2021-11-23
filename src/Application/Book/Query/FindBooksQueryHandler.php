<?php

declare(strict_types=1);

namespace App\Application\Book\Query;

use App\Application\Shared\Query\QueryHandlerInterface;
use App\Domain\Book\Model\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;

final class FindBooksQueryHandler implements QueryHandlerInterface
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    /**
     * @return iterable<Book>
     */
    public function __invoke(FindBooksQuery $query): iterable
    {
        return $this->repository->searchByCriteria($query->criteria);
    }
}
