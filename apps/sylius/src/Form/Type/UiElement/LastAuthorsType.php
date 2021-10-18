<?php

declare(strict_types=1);

namespace App\Form\Type\UiElement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType as FormTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class LastAuthorsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('count', FormTextType::class, [
                'required' => true,
                'label' => 'app.ui_element.last_authors.field.count',
                'constraints' => [
                    new Assert\NotBlank([]),
                    new Assert\Type('numeric'),
                    new Assert\GreaterThan(0),
                ],
            ])
        ;
    }
}
