<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\PriceCalculator;
use App\Form\PriceCalculatorType;
use App\Repository\CountryTaxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PriceCalculatorController extends AbstractController
{
    public function __construct(
        private readonly CountryTaxRepository $countryTaxRepository
    ) {}

    #[Route('/')]
    public function exec(Request $request): Response
    {
        $priceCalculator = new PriceCalculator($this->countryTaxRepository);
        $form = $this->createForm(PriceCalculatorType::class, $priceCalculator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                return $this->render('priceCalculator/result.html.twig', [
                    'price' => $priceCalculator->calculatePriceWithCountryTax(),
                ]);
            } catch (\DomainException $exception) {
                $form->addError(new FormError($exception->getMessage(), null));
            }
        }

        return $this->render('priceCalculator/form.html.twig', [
            'form' => $form,
        ]);
    }
}
