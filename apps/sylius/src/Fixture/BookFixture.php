<?php

declare(strict_types=1);

namespace App\Fixture;

use App\Fixture\Factory\BookFixtureFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class BookFixture extends AbstractResourceFixture
{
    public function __construct(EntityManagerInterface $bookManager, BookFixtureFactoryInterface $exampleFactory)
    {
        parent::__construct($bookManager, $exampleFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'app_book';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        /** @phpstan-ignore-next-line */
        $resourceNode
        ->children()
            ->scalarNode('author')->cannotBeEmpty()->end()
            ->arrayNode('translations')
                ->arrayPrototype()
                    ->children()
                        ->scalarNode('title')->cannotBeEmpty()->end()
                        ->scalarNode('description')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ->end()
        ;
    }
}
