<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\ApiPlatform\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Infrastructure\Book\ApiPlatform\Resource\BookResource;
use App\Infrastructure\Book\ApiPlatform\View\BookView;

final class BookViewDataTransformer implements DataTransformerInterface
{
    /**
     * @param BookResource $bookResource
     */
    public function transform($bookResource, string $to, array $context = []): BookView
    {
        return new BookView(
            $bookResource->isbn,
            $bookResource->title,
            $bookResource->description,
            $bookResource->author,
            $bookResource->publicationDate,
        );
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return BookView::class === $to && $data instanceof BookResource;
    }
}
