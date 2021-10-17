<?php

declare(strict_types=1);

namespace App\Entity\NoCommerce;

use Doctrine\ORM\Mapping as ORM;

trait AuthorAwareTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $author;

    public function getAuthor(): ?AuthorInterface
    {
        return $this->author;
    }

    public function setAuthor(?AuthorInterface $author): void
    {
        $this->author = $author;
    }
}
