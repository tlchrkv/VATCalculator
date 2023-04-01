<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Product;
use App\Form\Type\TaxNumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

final class PriceCalculatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ])
            ->add('taxNumber', TaxNumberType::class)
            ->add('calculate', SubmitType::class)
        ;
    }
}
