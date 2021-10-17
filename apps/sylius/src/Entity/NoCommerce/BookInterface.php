<?php

declare(strict_types=1);

namespace App\Entity\NoCommerce;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

interface BookInterface extends ResourceInterface, TimestampableInterface, TranslatableInterface
{
    public function getTitle(): ?string;

    public function setTitle(?string $title): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getAuthor(): ?AuthorInterface;

    public function setAuthor(?AuthorInterface $author): void;
}
