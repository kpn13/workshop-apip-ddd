<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInitializerInterface;
use App\Infrastructure\Book\ApiPlatform\Payload\BookPayload;
use App\Infrastructure\Book\ApiPlatform\Resource\BookResource;

final class BookPayloadDataTransformer implements DataTransformerInitializerInterface
{
    public function initialize(string $payloadClass, array $context = []): BookPayload
    {
        /** @var BookResource|null $bookResource */
        $bookResource = $context['object_to_populate'] ?? null;

        return new BookPayload(
            $bookResource?->isbn,
            $bookResource?->title,
            $bookResource?->description,
            $bookResource?->author,
            $bookResource?->publicationDate,
        );
    }

    /**
     * @param BookPayload $payload
     */
    public function transform($payload, string $to, array $context = []): BookResource
    {
        /** @var BookResource $book */
        $bookResource = $context['object_to_populate'] ?? new BookResource();

        $bookResource->isbn = $payload->isbn;
        $bookResource->title = $payload->title;
        $bookResource->description = $payload->description;
        $bookResource->author = $payload->author;
        $bookResource->publicationDate = $payload->publicationDate;

        return $bookResource;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return BookPayload::class === ($context['input']['class'] ?? null)
            && BookResource::class === $to
            && !$data instanceof BookPayload
        ;
    }
}
