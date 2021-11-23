<?php

declare(strict_types=1);

namespace App\Application\Book\Command;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Application\Shared\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'PrettifyBook',
    itemOperations: [],
    collectionOperations: [
        'post' => [
            'path' => '/books/{id}/prettify',
            'output' => false,
            'status' => 204,
        ],
    ]
)]
final class PrettifyBookCommand implements CommandInterface
{
    #[Assert\Positive]
    public string $id;
}
