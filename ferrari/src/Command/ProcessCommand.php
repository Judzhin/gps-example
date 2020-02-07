<?php

namespace App\Command;

use App\Message\ProcessMessage;
use App\Producer\ProcessProducer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class ProcessCommand
 * @package App\Command
 */
class ProcessCommand extends Command
{
    /** @var ProcessProducer */
    private $processProducer;

    /** @var string  */
    protected static $defaultName = 'gps:process';

    /**
     * ProcessCommand constructor.
     * @param ProcessProducer $processProducer
     */
    public function __construct(ProcessProducer $processProducer)
    {
        $this->processProducer = $processProducer;
        parent::__construct(self::$defaultName);
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    /**
     * @inheritDoc
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /** @var SymfonyStyle $io */
        $io = new SymfonyStyle($input, $output);

        $io->writeln(sprintf('Send message "%s"', $message->getContent()));

        return 0;
    }
}
