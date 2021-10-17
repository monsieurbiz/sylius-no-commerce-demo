<?php

declare(strict_types=1);

namespace App\Entity\NoCommerce;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface BookTranslationInterface extends ResourceInterface, TimestampableInterface, TranslationInterface
{
    public function getTitle(): ?string;

    public function setTitle(?string $title): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;
}
