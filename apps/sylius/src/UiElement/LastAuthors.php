<?php

declare(strict_types=1);

namespace App\UiElement;

use App\Repository\AuthorRepositoryInterface;
use MonsieurBiz\SyliusRichEditorPlugin\UiElement\UiElementInterface;
use MonsieurBiz\SyliusRichEditorPlugin\UiElement\UiElementTrait;

final class LastAuthors implements UiElementInterface
{
    use UiElementTrait;

    private AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function getAuthors(int $count): ?array
    {
        return $this->authorRepository->findLastAuthors($count);
    }
}
