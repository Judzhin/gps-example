<?php

namespace App\Subscriber;

use Enqueue\Client\TopicSubscriberInterface;
use Interop\Queue\Context;
use Interop\Queue\Message;
use Interop\Queue\Processor;
use Psr\Log\LoggerInterface;

/**
 * Class ProcessSubscriber
 * @package App\Subscriber
 */
class ProcessSubscriber implements Processor, TopicSubscriberInterface
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
     * @inheritDoc
     *
     * @param Message $message
     * @param Context $context
     * @return string
     */
    public function process(Message $message, Context $context): string
    {
        try {
            dump($message->getBody());
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return self::REQUEUE;
        }

        return self::ACK;
    }

    /**
     * @return array
     */
    public static function getSubscribedTopics(): array
    {
        return [
            'topic' => 'enqueue.default',
            'queue' => 'enqueue.default',
        ];
    }
}