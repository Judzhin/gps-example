<?php

namespace App\Command;

use Enqueue\Client\Message;
use Enqueue\Client\ProducerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class ProcessCommand
 * @package App\Command
 */
class ProcessCommand extends Command
{
    /** @var ProducerInterface */
    private $producer;

    /** @var string */
    protected static $defaultName = 'gps:process';

    /**
     * ProcessCommand constructor.
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
        parent::__construct(self::$defaultName);
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

        /** @var array $data */
        $data = [
            'key' => 'value',
            'datetime' => (new \DateTime)->format('d-m-Y H:i:s')
        ];

        // /** @var Message $message */
        // $message = new Message($data);
        // $this->producer->sendEvent('enqueue.default', $message);

        $this->producer->sendEvent('enqueue.default', json_encode($data));
        $io->writeln(sprintf('Send message "%s"', json_encode($data)));

        return 0;
    }
}
