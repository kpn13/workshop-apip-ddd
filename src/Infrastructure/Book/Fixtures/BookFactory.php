<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\Fixtures;

use App\Domain\Book\Model\Book;
use Zenstruck\Foundry\ModelFactory;

/**
 * @extends ModelFactory<Book>
 */
final class BookFactory extends ModelFactory
{
    /**
     * @return class-string<Book>
     */
    protected static function getClass(): string
    {
        return Book::class;
    }

    protected function getDefaults(): array
    {
        return [
            'isbn' => self::faker()->isbn10(),
            'title' => self::faker()->text(20),
            'description' => self::faker()->paragraph(),
            'author' => self::faker()->name(),
            'publicationDate' => self::faker()->dateTime(),
        ];
    }
}
