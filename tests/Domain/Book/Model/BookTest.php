<?php

declare(strict_types=1);

namespace App\Tests\Domain\Book\Model;

use App\Domain\Book\Model\Book;
use PHPUnit\Framework\TestCase;

final class BookTest extends TestCase
{
    public function testPrettify(): void
    {
        $book = new Book('isbn', 'title', 'description', 'author', new \DateTimeImmutable());
        $book->prettify();

        self::assertSame('Title', $book->getTitle());
        self::assertSame('AUTHOR', $book->getAuthor());
    }

    public function testChangeTitle(): void
    {
        $book = new Book('isbn', 'title', 'description', 'author', new \DateTimeImmutable());
        $book->changeTitle('new title');

        self::assertSame('new title', $book->getTitle());
    }

    public function testChangeDescription(): void
    {
        $book = new Book('isbn', 'title', 'description', 'author', new \DateTimeImmutable());
        $book->changeDescription('new description');

        self::assertSame('new description', $book->getDescription());
    }
}
