<?php

declare(strict_types=1);

namespace App\Fixture\Factory;

use App\Entity\NoCommerce\AuthorInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorFixtureFactory extends AbstractExampleFactory implements AuthorFixtureFactoryInterface
{
    private FactoryInterface $authorFactory;

    private OptionsResolver $optionsResolver;

    private \Faker\Generator $faker;

    public function __construct(
        FactoryInterface $authorFactory
    ) {
        $this->authorFactory = $authorFactory;
        $this->faker = \Faker\Factory::create();
        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): AuthorInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var AuthorInterface $author */
        $author = $this->authorFactory->createNew();
        $author->setFirstName($options['firstName']);
        $author->setLastName($options['lastName']);

        return $author;
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('firstName', function(Options $options): string {
                return $this->faker->firstName();
            })
            ->setDefault('lastName', function(Options $options): string {
                return $this->faker->lastName();
            })
        ;
    }
}
