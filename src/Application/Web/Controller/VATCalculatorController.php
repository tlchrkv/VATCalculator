<?php

declare(strict_types=1);

namespace App\Application\Web\Controller;

use App\Application\Web\Form\VATCalculatorType;
use App\Application\Web\VATCalculator;
use App\Domain\VATRateResolver\VATRateResolver;
use App\Domain\VATRateResolver\VATRateResolverError;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class VATCalculatorController extends AbstractController
{
    public function __construct(
        private readonly VATRateResolver $VATRateResolver
    ) {}

    #[Route('/')]
    public function exec(Request $request): Response
    {
        $VATCalculator = new VATCalculator($this->VATRateResolver);
        $form = $this->createForm(VATCalculatorType::class, $VATCalculator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                return $this->render('VATCalculator/result.html.twig', [
                    'price' => $VATCalculator->calculateVATInclusivePrice(),
                ]);
            } catch (VATRateResolverError) {
                $form->get('TIN')->addError(new FormError('We can\'t handle this TIN', null));
            }
        }

        return $this->render('VATCalculator/form.html.twig', [
            'form' => $form,
        ]);
    }
}
