<?php

declare(strict_types=1);

namespace App\Application\Web\Form;

use App\Application\Web\Form\TINType\TINType;
use App\Domain\Product\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

final class VATCalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ])
            ->add('TIN', TINType::class, ['label' => 'Tax ID number'])
            ->add('calculate', SubmitType::class)
        ;
    }
}
