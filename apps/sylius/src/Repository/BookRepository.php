<?php

declare(strict_types=1);

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class BookRepository extends EntityRepository implements BookRepositoryInterface
{
    public function createListQueryBuilder(string $localeCode): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation', 'WITH', 'translation.locale = :localeCode')
            ->setParameter('localeCode', $localeCode)
        ;
    }

    public function createAuthorListQueryBuilder(string $localeCode, string $authorId): Pagerfanta
    {
        $queryBuilder = $this
            ->createListQueryBuilder($localeCode)
            ->where('IDENTITY(o.author) = :authorId')
            ->setParameter('authorId', (int) $authorId)
            ->orderBy('translation.title')
        ;
        return EntityRepository::getPaginator($queryBuilder);
    }
}
