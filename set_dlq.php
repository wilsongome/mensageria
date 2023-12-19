<?php

use app\Publisher;
use app\QueueManager;

require_once __DIR__."/vendor/autoload.php";

$queueManager = new QueueManager();
$queueManager->setExchange("ex.faturamento", "direct");
$queueManager->setQueue("queue.errors", null);
$queueManager->bind($queueManager->getQueueName(), $queueManager->getExchangeName(), $queueManager->getQueueName());
