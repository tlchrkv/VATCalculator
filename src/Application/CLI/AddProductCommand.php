<?php

declare(strict_types=1);

namespace App\Application\CLI;

use App\Domain\Product\AddProductService;
use Money\Currency;
use Money\Money;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;

#[AsCommand(name: 'app:add-product')]
final class AddProductCommand extends Command
{
    public function __construct(private readonly AddProductService $addProductService)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Product name')
            ->addArgument('price', InputArgument::REQUIRED, 'Price in EUR')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ($this->addProductService)(
            Uuid::v4(),
            $input->getArgument('name'),
            new Money(
                (int) (((float) $input->getArgument('price')) * 100),
                new Currency('EUR')
            )
        );

        return Command::SUCCESS;
    }
}
