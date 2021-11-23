<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\ApiPlatform\Resource;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Domain\Stock\Model\Stock;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Stock',
    itemOperations: ['get' => []],
    collectionOperations: [],
)]
final class StockResource
{
    #[Assert\Positive]
    public ?string $id = null;

    #[Assert\Positive]
    public int $quantity;

    public string $bookId;

    public static function fromModel(Stock $model): self
    {
        $resource = new self();

        $resource->id = $model->getId();
        $resource->quantity = $model->getQuantity();
        $resource->bookId = $model->getBookId();

        return $resource;
    }
}
