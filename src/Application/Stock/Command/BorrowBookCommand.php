<?php

declare(strict_types=1);

namespace App\Application\Stock\Command;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Application\Shared\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'BorrowBook',
    itemOperations: [],
    collectionOperations: [
        'post' => [
            'path' => '/books/{id}/borrow',
            'output' => false,
            'status' => 204,
        ],
    ]
)]
final class BorrowBookCommand implements CommandInterface
{
    #[Assert\Positive]
    public string $bookId;
}
