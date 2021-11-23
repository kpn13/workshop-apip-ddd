<?php

declare(strict_types=1);

namespace App\Domain\Shared\Criteria;

final class Criteria
{
    /**
     * @param iterable<Filter> $filters
     */
    public function __construct(
        public iterable $filters,
    ) {
    }
}
