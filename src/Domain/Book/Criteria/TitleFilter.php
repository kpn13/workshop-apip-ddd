<?php

declare(strict_types=1);

namespace App\Domain\Book\Criteria;

use App\Domain\Shared\Criteria\Filter;

final class TitleFilter extends Filter
{
    public function __construct(mixed $value)
    {
        parent::__construct('title', self::LIKE, $value);
    }
}
