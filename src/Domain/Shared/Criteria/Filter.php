<?php

declare(strict_types=1);

namespace App\Domain\Shared\Criteria;

class Filter
{
    public const EQUAL = '=';
    public const LIKE = 'LIKE';

    public function __construct(
        public string $field,
        public string $operator,
        public mixed $value,
    ) {
    }
}
