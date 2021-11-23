<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\Book\Command\CreateBookCommand;
use App\Application\Book\Command\DeleteBookCommand;
use App\Application\Book\Command\UpdateBookCommand;
use App\Application\Shared\Command\CommandBusInterface;
use App\Domain\Book\Model\Book;
use App\Infrastructure\Book\ApiPlatform\Resource\BookResource;

final class BookDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(private CommandBusInterface $commandBus)
    {
    }

    /**
     * @param BookResource $data
     */
    public function persist($data, array $context = []): BookResource
    {
        $command = null === $data->id
            ? new CreateBookCommand($data->isbn, $data->title, $data->description, $data->author, $data->publicationDate)
            : new UpdateBookCommand($data->id, $data->title, $data->description)
        ;

        /** @var Book $createdBook */
        $book = $this->commandBus->dispatch($command);

        return BookResource::fromModel($book);
    }

    /**
     * @param BookResource $data
     */
    public function remove($data, array $context = []): void
    {
        $this->commandBus->dispatch(new DeleteBookCommand($data->id));
    }

    /**
     * @param mixed $data
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof BookResource;
    }
}
