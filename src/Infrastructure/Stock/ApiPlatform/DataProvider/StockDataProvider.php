<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\ApiPlatform\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\Shared\Query\QueryBusInterface;
use App\Application\Stock\Query\FindStockQuery;
use App\Domain\Stock\Model\Stock;
use App\Infrastructure\Stock\ApiPlatform\Resource\StockResource;

final class StockDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    /**
     * @var string
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?StockResource
    {
        /** @var Stock|null $stock */
        $stock = $this->queryBus->ask(new FindStockQuery($id));

        return null !== $stock ? StockResource::fromModel($stock) : null;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return StockResource::class === $resourceClass;
    }
}
