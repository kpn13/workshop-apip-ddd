<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Application\Book\Query\FindBookQuery;
use App\Application\Book\Query\FindBooksQuery;
use App\Application\Shared\Query\QueryBusInterface;
use App\Domain\Book\Criteria\TitleFilter;
use App\Domain\Book\Model\Book;
use App\Domain\Shared\Criteria\Criteria;
use App\Infrastructure\Book\ApiPlatform\Resource\BookResource;

final class BookDataProvider implements ItemDataProviderInterface, ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(private QueryBusInterface $queryBus)
    {
    }

    /**
     * @var string
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?BookResource
    {
        /** @var Book|null $book */
        $book = $this->queryBus->ask(new FindBookQuery($id));

        return null !== $book ? BookResource::fromModel($book) : null;
    }

    /**
     * @return iterable<BookResource>
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $filters = [];
        if (null !== $title = ($context['filters']['title'] ?? null)) {
            $filters[] = new TitleFilter($title);
        }

        /** @var iterable<Book> $books */
        $books = $this->queryBus->ask(new FindBooksQuery(new Criteria($filters)));

        $result = [];
        foreach ($books as $key => $book) {
            $result[$key] = BookResource::fromModel($book);
        }

        return $result;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return BookResource::class === $resourceClass;
    }
}
