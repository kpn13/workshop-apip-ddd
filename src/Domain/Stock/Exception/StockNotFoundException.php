<?php

declare(strict_types=1);

namespace App\Domain\Stock\Exception;

use App\Domain\Shared\Exception\NotFoundException;

final class StockNotFoundException extends NotFoundException
{
}
