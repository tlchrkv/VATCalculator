<?php

declare(strict_types=1);

namespace App\Application\CLI;

use App\Domain\VATRateResolver\CountryCode\CountryCode;
use App\Domain\VATRateResolver\VAT\AddVATService;
use App\Domain\VATRateResolver\VAT\VATRate\VATRate;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;

#[AsCommand(name: 'app:add-vat')]
final class AddVATCommand extends Command
{
    public function __construct(
        private readonly AddVATService $addVATService
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('country_code', InputArgument::REQUIRED, 'Country code (2 symbols)')
            ->addArgument('rate', InputArgument::REQUIRED, 'VAT rate')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        ($this->addVATService)(
            Uuid::v4(),
            new CountryCode($input->getArgument('country_code')),
            new VATRate((int) $input->getArgument('rate')),
       );

        return Command::SUCCESS;
    }
}
