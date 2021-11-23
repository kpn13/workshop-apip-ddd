<?php

declare(strict_types=1);

namespace App\Infrastructure\Book\Repository\Doctrine;

use App\Domain\Book\Exception\BookNotFoundException;
use App\Domain\Book\Model\Book;
use App\Domain\Book\Repository\BookRepositoryInterface;
use App\Domain\Shared\Criteria\Criteria;
use App\Domain\Shared\Criteria\Filter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class BookRepository extends ServiceEntityRepository implements BookRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function search(string $id): ?Book
    {
        return $this->find($id);
    }

    /**
     * @return iterable<Book>
     */
    public function searchByCriteria(Criteria $criteria): iterable
    {
        $qb = $this->createQueryBuilder('b');

        foreach ($criteria->filters as $i => $filter) {
            if (Filter::EQUAL === $filter->operator) {
                $qb
                    ->andWhere(sprintf('b.%s = :value_%d', $filter->field, $i))
                    ->setParameter(sprintf('value_%d', $i), $filter->value)
                ;

                continue;
            }

            if (Filter::LIKE === $filter->operator) {
                $qb
                    ->andWhere(sprintf('b.%s LIKE :value_%d', $filter->field, $i))
                    ->setParameter(sprintf('value_%d', $i), sprintf('%%%s%%', $filter->value))
                ;

                continue;
            }
        }

        return $qb->getQuery()->getResult();
    }

    public function save(Book $book): void
    {
        $this->getEntityManager()->persist($book);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws BookNotFoundException
     */
    public function delete(string $id): void
    {
        /** @var Book|null $book */
        $book = $this->search($id);

        if (null === $book) {
            throw new BookNotFoundException();
        }

        $this->getEntityManager()->remove($book);
        $this->getEntityManager()->flush();
    }
}
