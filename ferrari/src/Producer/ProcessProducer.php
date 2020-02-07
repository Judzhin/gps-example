<?php


namespace App\Producer;

use Enqueue\Client\ProducerInterface;

/**
 * Class ProcessProducer
 * @package App\Producer
 */
class ProcessProducer
{
    /** @var ProducerInterface */
    private $producer;

    /**
     * ProcessProducer constructor.
     * @param ProducerInterface $producer
     */
    public function __construct(ProducerInterface $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param $data
     */
    public function send($data): void
    {
        $this->producer->sendCommand('supercar', $data);
    }
}