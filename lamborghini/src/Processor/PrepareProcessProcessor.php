<?php
namespace App\Processor;

use Enqueue\Client\CommandSubscriberInterface;
use Interop\Queue\Context;
use Interop\Queue\Message;
use Interop\Queue\Processor;
use Psr\Log\LoggerInterface;

/**
 * Class PrepareProcessProcessor
 * @package App\Processor
 */
class PrepareProcessProcessor implements Processor, CommandSubscriberInterface
{
    /** @var LoggerInterface */
    private $logger;

    /**
     * PrepareProcessProcessor constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Message $message
     * @param Context $context
     * @return object|string
     */
    public function process(Message $message, Context $context)
    {
        /** @var array $body */
        $body = json_decode($message->getBody(), true);

        try {
            // Do something with the message received
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());

            return self::REQUEUE;
        }

        return self::ACK;
    }

    /**
     * @return array
     */
    public static function getSubscribedCommand(): array
    {
        return [
            'processor_name' => 'mailer.processor',
            'queueName' => 'emails',
            'queueNameHardcoded' => true,
            'exclusive' => true
        ];
    }
}