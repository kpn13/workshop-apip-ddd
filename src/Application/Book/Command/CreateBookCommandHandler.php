<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandHandlerInterface;
use App\Domain\Book\Model\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;

final class CreateBookCommandHandler implements CommandHandlerInterface
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    public function __invoke(CreateBookCommand $command): Book
    {
        $book = new Book(
            $command->isbn,
            $command->title,
            $command->description,
            $command->author,
            $command->publicationDate,
        );

        $this->repository->save($book);

        return $book;
    }
}
