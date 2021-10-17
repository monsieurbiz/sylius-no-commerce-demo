<?php

/*
 * This file is part of Meet my Coach corporate website.
 *
 * (c) Meet my Coach <sylius+meetmycoach@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\NoCommerce\Author;
use App\Entity\NoCommerce\AuthorInterface;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

final class BookType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => BookTranslationType::class,
            ])
            ->add('author', EntityType::class, [
                'class' => Author::class,
                'label' => 'app.ui.author',
                'required' => true,
                'choice_label' => function(AuthorInterface $author, $key, $index) {
                    return sprintf('%s %s', $author->getFirstName(), $author->getLastName());
                },
            ])
        ;
    }
}
