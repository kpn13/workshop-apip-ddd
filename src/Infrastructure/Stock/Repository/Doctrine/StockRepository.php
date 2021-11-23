<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\Repository\Doctrine;

use App\Domain\Stock\Model\Stock;
use App\Domain\Stock\Repository\StockRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class StockRepository extends ServiceEntityRepository implements StockRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

    public function search(string $id): ?Stock
    {
        return $this->find($id);
    }

    public function save(Stock $stock): void
    {
        $this->getEntityManager()->persist($stock);
        $this->getEntityManager()->flush();
    }
}
