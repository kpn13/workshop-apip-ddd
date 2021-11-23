<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandHandlerInterface;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Model\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;

final class UpdateBookCommandHandler implements CommandHandlerInterface
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    /**
     * @throws BookNotFoundException
     */
    public function __invoke(UpdateBookCommand $command): Book
    {
        $book = $this->repository->search($command->id);

        if (null === $book) {
            throw new BookNotFoundException();
        }

        $book->changeTitle($command->title);
        $book->changeDescription($command->description);

        $this->repository->save($book);

        return $book;
    }
}
