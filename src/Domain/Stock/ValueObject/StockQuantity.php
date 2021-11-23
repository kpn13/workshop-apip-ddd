<?php

namespace App\Domain\Stock\ValueObject;

use App\Domain\Stock\Exception\EmptyStockException;

final class StockQuantity
{
    public function __construct(int $quantity)
    {
        if (0 > $quantity) {
            throw new EmptyStockException();
        }

        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
