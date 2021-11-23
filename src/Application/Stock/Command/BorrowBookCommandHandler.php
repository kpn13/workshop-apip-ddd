<?php

declare(strict_types=1);

namespace App\Application\Stock\Command;

use App\Application\Shared\Command\CommandHandlerInterface;
use App\Domain\Stock\Exception\EmptyStockException;
use App\Domain\Stock\Exception\StockNotFoundException;
use App\Domain\Stock\Repository\StockRepositoryInterface;

final class BorrowBookCommandHandler implements CommandHandlerInterface
{
    public function __construct(private StockRepositoryInterface $repository)
    {
    }

    /**
     * @throws StockNotFoundException|EmptyStockException
     */
    public function __invoke(BorrowBookCommand $command): void
    {
        $stock = $this->repository->searchByBook($command->bookId);

        if (null === $stock) {
            throw new StockNotFoundException();
        }

        $stock->decrease();

        $this->repository->save($stock);
    }
}
