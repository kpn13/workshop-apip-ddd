<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\Fixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

final class BookFixtures extends Fixture
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function load(ObjectManager $manager): void
    {
        BookFactory::createOne([
            'isbn' => '6613583936',
            'title' => 'a very custom title',
            'description' => 'description',
            'author' => 'author',
            'publicationDate' => new \DateTimeImmutable('2021-11-24 00:00:00'),
        ]);
        BookFactory::createOne([
            'title' => 'title',
            'author' => 'author',
        ]);
        BookFactory::createMany(8);

        $this->em->getConnection()->executeStatement("UPDATE book SET id = '00000000-0000-0000-0000-000000000001' WHERE title = 'a very custom title'");
        $this->em->getConnection()->executeStatement("UPDATE book SET id = '00000000-0000-0000-0000-000000000002' WHERE title = 'title'");
    }
}
