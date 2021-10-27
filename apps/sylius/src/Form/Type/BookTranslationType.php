<?php

declare(strict_types=1);

namespace App\Form\Type;

use MonsieurBiz\SyliusRichEditorPlugin\Form\Type\RichEditorType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class BookTranslationType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'app.ui.title',
                'required' => true,
            ])
            ->add('description', RichEditorType::class, [
                'label' => 'app.ui.description',
                'required' => true,
            ])
        ;
    }
}
