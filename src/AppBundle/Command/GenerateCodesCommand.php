<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCodesCommand extends ContainerAwareCommand
{
    const FILE_NAME = 'codes.txt';

    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this
            ->setName('codes:generate')
            ->setDescription('Generates alphanumeric codes')
            ->addArgument('quantity', InputArgument::REQUIRED, 'Quantity of codes')
            ->addArgument('length', InputArgument::REQUIRED, 'Length of code')
            ->addOption(
                'save',
                's',
                InputOption::VALUE_NONE,
                'Saves generated codes to txt file'
                );
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $quantity = $input->getArgument('quantity');
        $length = $input->getArgument('length');

        $codes = $this->getContainer()
            ->get('app.alphanumeric_code_generator')
            ->generateCodes($quantity, $length);

        if ($input->getOption('save')) {
            $this->getContainer()
                ->get('app.text_file_generator')
                ->generateFile($codes, self::FILE_NAME);

            $output->write("Codes saved in directory defined in parameters.yml");
        } else {
            $output->writeln($codes);
        }
    }
}