<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Form\DataTransformer\TaxNumberTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class TaxNumberType extends AbstractType
{
    public function __construct(
        private readonly TaxNumberTransformer $transformer,
    ) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'invalid_message' => 'Invalid tax number',
        ]);
    }

    public function getParent(): string
    {
        return TextType::class;
    }
}
