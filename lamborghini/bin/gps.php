<?php

use Enqueue\Gps\GpsConnectionFactory;
use Enqueue\Gps\GpsContext;

require dirname(__DIR__) . '/vendor/autoload.php';

/** @var GpsConnectionFactory $connectionFactory */
$connectionFactory = new GpsConnectionFactory('gps:?progectId=gofintech-ua-dev&keyFilePath=keyFile.json');

/** @var GpsContext $context */
$context = $connectionFactory->createContext();

$fooTopic = $context->createTopic('enqueue.default');
$fooQueue = $context->createQueue('enqueue.default');

$context->subscribe($fooTopic, $fooQueue);

$consumer = $context->createConsumer($fooQueue);
$message = $consumer->receive();

// process a message
var_dump($message->getBody());

$consumer->acknowledge($message);