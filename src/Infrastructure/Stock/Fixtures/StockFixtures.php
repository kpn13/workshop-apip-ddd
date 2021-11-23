<?php

declare(strict_types=1);

namespace App\Infrastructure\Stock\Fixtures;

use App\Domain\Stock\ValueObject\StockQuantity;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

final class StockFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function load(ObjectManager $manager): void
    {
        StockFactory::createOne([
            'quantity' => new StockQuantity(10),
            'bookId' => '00000000-0000-0000-0000-000000000001',
        ]);
        StockFactory::createMany(9);

        $this->em->getConnection()->executeStatement("UPDATE stock SET id = '00000000-0000-0000-0000-000000000001' WHERE book_id = '00000000-0000-0000-0000-000000000001'");
    }
}
