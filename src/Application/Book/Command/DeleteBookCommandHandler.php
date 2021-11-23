<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use App\Application\Shared\Command\CommandHandlerInterface;
use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Repository\BookRepositoryInterface;

final class DeleteBookCommandHandler implements CommandHandlerInterface
{
    public function __construct(private BookRepositoryInterface $repository)
    {
    }

    /**
     * @throws BookNotFoundException
     */
    public function __invoke(DeleteBookCommand $command): void
    {
        $this->repository->delete($command->id);
    }
}
