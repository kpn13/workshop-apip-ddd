<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\ApiPlatform\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Infrastructure\Stock\ApiPlatform\Resource\StockResource;

final class StockDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /**
     * @var string
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?StockResource
    {
        throw new \BadMethodCallException(sprintf('%s() have to be implemented', __METHOD__));
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        throw new \BadMethodCallException(sprintf('%s() have to be implemented', __METHOD__));
    }
}
