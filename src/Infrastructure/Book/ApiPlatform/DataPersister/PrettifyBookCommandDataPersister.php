<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\Book\Command\PrettifyBookCommand;
use App\Application\Shared\Command\CommandBusInterface;
use BadMethodCallException;
use Symfony\Component\HttpFoundation\RequestStack;

final class PrettifyBookCommandDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private CommandBusInterface $commandBus,
        private RequestStack $requestStack,
    ) {
    }

    /**
     * @param PrettifyBookCommand $data
     */
    public function persist($data, array $context = []): void
    {
        $data->id = $this->requestStack->getCurrentRequest()->get('id');

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
        return $data instanceof PrettifyBookCommand;
    }
}
