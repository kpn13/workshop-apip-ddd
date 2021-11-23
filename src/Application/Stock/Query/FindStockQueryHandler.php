<?php

declare(strict_types=1);

namespace App\Application\Stock\Query;

use App\Application\Shared\Query\QueryHandlerInterface;
use App\Domain\Stock\Model\Stock;
use App\Domain\Stock\Repository\StockRepositoryInterface;

final class FindStockQueryHandler implements QueryHandlerInterface
{
    public function __construct(private StockRepositoryInterface $repository)
    {
    }

    public function __invoke(FindStockQuery $query): ?Stock
    {
        return $this->repository->search($query->id);
    }
}
