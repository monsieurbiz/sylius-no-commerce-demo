<?php

declare(strict_types=1);

namespace App\Fixture;

use App\Fixture\Factory\AuthorFixtureFactoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class AuthorFixture extends AbstractResourceFixture
{
    public function __construct(EntityManagerInterface $authorManager, AuthorFixtureFactoryInterface $exampleFactory)
    {
        parent::__construct($authorManager, $exampleFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'app_author';
    }

    /**
     * {@inheritdoc}
     */
    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        /** @phpstan-ignore-next-line */
        $resourceNode
            ->children()
                ->scalarNode('firstName')->cannotBeEmpty()->end()
                ->scalarNode('lastName')->cannotBeEmpty()->end()
            ->end()
        ;
    }
}
