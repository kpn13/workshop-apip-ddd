<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandHandlerInterface;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;

final class PrettifyBookCommandHandler implements CommandHandlerInterface
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    /**
     * @throws BookNotFoundException
     */
    public function __invoke(PrettifyBookCommand $command): void
    {
        $book = $this->repository->search($command->id);

        if (null === $book) {
            throw new BookNotFoundException();
        }

        $book->prettify();

        $this->repository->save($book);
    }
}
