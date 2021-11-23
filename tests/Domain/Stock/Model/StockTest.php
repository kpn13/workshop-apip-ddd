<?php

declare(strict_types=1);

namespace App\Tests\Domain\Stock\Model;

use App\Domain\Stock\Exception\EmptyStockException;
use App\Domain\Stock\Model\Stock;
use App\Domain\Stock\ValueObject\StockQuantity;
use PHPUnit\Framework\TestCase;

final class StockTest extends TestCase
{
    public function testDecreaseStock(): void
    {
        $stock = new Stock(new StockQuantity(10), 'bookId');
        $stock->decrease();

        self::assertSame(9, $stock->getQuantity());
        $this->expectException(EmptyStockException::class);
        (new Stock(new StockQuantity(0), 'bookId'))->decrease();
    }
}
