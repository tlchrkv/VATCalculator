<?php

declare(strict_types=1);

namespace App\Application\Web\Form\TINType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class TINType extends AbstractType
{
    public function __construct(private readonly TINTransformer $transformer) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->transformer);
    }

    public function getParent(): string
    {
        return TextType::class;
    }
}
