<?php

declare(strict_types=1);

namespace App\Domain\Stock\Repository;

use App\Domain\Stock\Model\Stock;

interface StockRepositoryInterface
{
    public function search(string $id): ?Stock;

    public function save(Stock $stock): void;
}
