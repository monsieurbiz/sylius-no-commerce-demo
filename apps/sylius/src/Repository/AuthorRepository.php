<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NoCommerce\AuthorInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class AuthorRepository extends EntityRepository implements AuthorRepositoryInterface
{
    public function findByFullName(string $fullName): ?AuthorInterface
    {
        $queryBuilder = $this->createQueryBuilder('o');
        return $queryBuilder
            ->where(
                $queryBuilder->expr()->eq(
                    $queryBuilder->expr()->concat('o.firstName', $queryBuilder->expr()->concat($queryBuilder->expr()->literal(' '), 'o.lastName')),
                    ':fullName'
                )
            )
            ->setParameter('fullName', $fullName)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findLastAuthors(int $count): array
    {
        return $this
            ->createQueryBuilder('o')
            ->orderBy('o.createdAt', 'desc')
            ->addOrderBy('o.id', 'desc')
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
        ;
    }
}
