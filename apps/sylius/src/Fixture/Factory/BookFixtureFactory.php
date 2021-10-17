<?php

declare(strict_types=1);

namespace App\Fixture\Factory;

use App\Entity\NoCommerce\AuthorInterface;
use App\Entity\NoCommerce\BookInterface;
use App\Repository\AuthorRepositoryInterface;
use Sylius\Bundle\CoreBundle\Fixture\Factory\AbstractExampleFactory;
use Sylius\Bundle\CoreBundle\Fixture\OptionsResolver\LazyOption;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\NoCommerce\BookTranslationInterface;

class BookFixtureFactory extends AbstractExampleFactory implements BookFixtureFactoryInterface
{
    private FactoryInterface $bookFactory;

    private FactoryInterface $bookTranslationFactory;

    private AuthorRepositoryInterface $authorRepository;

    private $optionsResolver;

    private \Faker\Generator $faker;

    private RepositoryInterface $localeRepository;

    public function __construct(
        FactoryInterface $bookFactory,
        FactoryInterface $bookTranslationFactory,
        RepositoryInterface $authorRepository,
        RepositoryInterface $localeRepository
    ) {
        $this->bookFactory = $bookFactory;
        $this->bookTranslationFactory = $bookTranslationFactory;
        $this->authorRepository = $authorRepository;
        $this->localeRepository = $localeRepository;

        $this->faker = \Faker\Factory::create();

        $this->optionsResolver = new OptionsResolver();
        $this->configureOptions($this->optionsResolver);
    }

    public function create(array $options = []): BookInterface
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var BookInterface $book */
        $book = $this->bookFactory->createNew();
        if (null !== $options['author']) {
            $book->setAuthor($this->authorRepository->findByFullName($options['author']));
        } else {
            $book->setAuthor($this->faker->randomElement($this->authorRepository->findAll()));
        }
        $this->createTranslations($book, $options);

        return $book;
    }

    private function createTranslations(BookInterface $book, array $options): void
    {
        foreach ($options['translations'] as $localeCode => $translation) {
            /** @var BookTranslationInterface $bookTranslation */
            $bookTranslation = $this->bookTranslationFactory->createNew();
            $bookTranslation->setLocale($localeCode);
            $bookTranslation->setTitle($translation['title']);
            $bookTranslation->setDescription($translation['description']);

            $book->addTranslation($bookTranslation);
        }
    }

    protected function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefault('translations', function(OptionsResolver $translationResolver): void {
                $translationResolver->setDefaults($this->configureDefaultTranslations());
            })
            ->setDefault('author', null)
        ;
    }

    private function configureDefaultTranslations(): array
    {
        $translations = [];
        $locales = $this->localeRepository->findAll();
        /** @var LocaleInterface $locale */
        foreach ($locales as $locale) {
            $translations[$locale->getCode()] = [
                'title' => ucfirst($this->faker->words(3, true)),
                'description' => $this->faker->paragraphs(3, true),
            ];
        }

        return $translations;
    }
}
