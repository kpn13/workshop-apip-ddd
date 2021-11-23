<?php

declare(strict_types=1);

namespace App\Domain\Stock\Model;

use App\Domain\Stock\ValueObject\StockQuantity;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

#[ORM\Entity]
class Stock
{
    #[ORM\Id]
    #[ORM\Column(type: 'string', unique: true)]
    private string $id;

    #[ORM\Column(type: 'stock_quantity')]
    private StockQuantity $quantity;

    #[ORM\Column(type: 'string')]
    private string $bookId;

    public function __construct(
        StockQuantity $quantity,
        string $bookId,
    ) {
        $this->id = (string) Uuid::uuid4();
        $this->quantity = $quantity;
        $this->bookId = $bookId;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuantity(): int
    {
        return $this->quantity->getQuantity();
    }

    public function getBookId(): string
    {
        return $this->bookId;
    }

    public function decrease(): void
    {
        $this->quantity = new StockQuantity($this->quantity->getQuantity() - 1);
    }
}
