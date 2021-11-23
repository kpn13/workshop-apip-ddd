<?php

declare(strict_types=1);

namespace App\Tests\Domain\Stock\ValueObject;

use App\Domain\Stock\Exception\EmptyStockException;
use App\Domain\Stock\ValueObject\StockQuantity;
use PHPUnit\Framework\TestCase;

final class StockQuantityTest extends TestCase
{
    public function testConstruct(): void
    {
        $this->expectException(EmptyStockException::class);
        new StockQuantity(-1);
    }
}
