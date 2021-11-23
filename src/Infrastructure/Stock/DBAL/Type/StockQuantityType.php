<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\DBAL\Type;

use App\Domain\Stock\ValueObject\StockQuantity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use UnexpectedValueException;

final class StockQuantityType extends IntegerType
{
    public const NAME = 'stock_quantity';

    /**
     * @param StockQuantity $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): int
    {
        return parent::convertToDatabaseValue($value->getQuantity(), $platform);
    }

    /**
     * @param StockQuantity|null $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?StockQuantity
    {
        /**
         * @var int $phpValue
         */
        $phpValue = parent::convertToPHPValue($value, $platform);

        try {
            return new StockQuantity($phpValue);
        } catch (UnexpectedValueException) {
            return null;
        }
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
