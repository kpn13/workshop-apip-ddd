<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\ApiPlatform\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\Shared\Command\CommandBusInterface;
use App\Application\Stock\Command\BorrowBookCommand;
use BadMethodCallException;
use Symfony\Component\HttpFoundation\RequestStack;

final class BorrowBookDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private RequestStack $requestStack,
    ) {
    }

    /**
     * @param BorrowBookCommand $data
     */
    public function persist($data, array $context = []): void
    {
        $data->bookId = $this->requestStack->getCurrentRequest()->get('id');

        $this->commandBus->dispatch($data);
    }

    public function remove($data, array $context = []): void
    {
        throw new BadMethodCallException(sprintf('%s() should not be called.', __METHOD__));
    }

    /**
     * @param mixed $data
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof BorrowBookCommand;
    }
}
