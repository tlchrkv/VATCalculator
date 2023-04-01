<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Money\Currency;
use Money\Money;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;

#[AsCommand(name: 'app:create-product')]
final class CreateProductCommand extends Command
{
    public function __construct(
        private readonly ProductRepository $productRepository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Product name')
            ->addArgument('price', InputArgument::REQUIRED, 'PriceCalculator in EUR')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->productRepository->save(
            new Product(
                Uuid::v4(),
                $input->getArgument('name'),
                new Money(
                    (int) (((float) $input->getArgument('price')) * 100),
                    new Currency('EUR')
                )
            ),
            flush: true
        );

        return Command::SUCCESS;
    }
}
