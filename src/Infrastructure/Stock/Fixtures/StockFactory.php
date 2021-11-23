<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\Fixtures;

use App\Domain\Stock\Model\Stock;
use App\Domain\Stock\ValueObject\StockQuantity;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Stock>
 */
final class StockFactory extends ModelFactory
{
    /**
     * @return class-string<Stock>
     */
    protected static function getClass(): string
    {
        return Stock::class;
    }

    protected function getDefaults(): array
    {
        return [
            'quantity' => new StockQuantity(self::faker()->numberBetween(0, 1000)),
            'bookId' => self::faker()->uuid(),
        ];
    }
}
