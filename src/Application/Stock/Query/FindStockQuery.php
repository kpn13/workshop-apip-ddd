<?php

declare(strict_types=1);

namespace App\Application\Stock\Query;

use App\Application\Shared\Query\QueryInterface;

final class FindStockQuery implements QueryInterface
{
    public function __construct(public string $id)
    {
    }
}
