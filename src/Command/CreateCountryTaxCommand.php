<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Shared\CountryCode;
use App\Entity\Taxes\CountryTax;
use App\Entity\Taxes\TaxPercent;
use App\Repository\CountryTaxRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Uuid;

#[AsCommand(name: 'app:create-country-tax')]
final class CreateCountryTaxCommand extends Command
{
    public function __construct(
        private readonly CountryTaxRepository $countryTaxRepository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('country_code', InputArgument::REQUIRED, 'Country code (2 symbols)')
            ->addArgument('tax', InputArgument::REQUIRED, 'Tax percent')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->countryTaxRepository->save(
            new CountryTax(
                Uuid::v4(),
                new CountryCode($input->getArgument('country_code')),
                new TaxPercent((int) $input->getArgument('tax')),
            ),
            flush: true
        );

        return Command::SUCCESS;
    }
}
