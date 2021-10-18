<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NoCommerce\AuthorInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface AuthorRepositoryInterface extends RepositoryInterface
{
    public function findByFullName(string $fullName): ?AuthorInterface;

    public function findLastAuthors(int $count): array;
}
