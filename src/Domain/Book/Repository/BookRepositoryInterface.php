<?php

declare(strict_types=1);

namespace App\Domain\Book\Repository;

use App\Domain\Book\Model\Book;
use App\Domain\Shared\Criteria\Criteria;

interface BookRepositoryInterface
{
    public function search(string $id): ?Book;

    /**
     * @return iterable<Book>
     */
    public function searchByCriteria(Criteria $criteria): iterable;

    public function save(Book $book): void;

    public function delete(string $id): void;
}
