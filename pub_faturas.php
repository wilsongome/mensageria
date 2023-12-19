<?php

use app\Publisher;
use app\QueueManager;
use PhpAmqpLib\Wire\AMQPTable;

require_once __DIR__."/vendor/autoload.php";

$queueManager = new QueueManager();
$queueManager->setExchange("ex.faturamento", "direct");

$dlk = new AMQPTable([
    'x-dead-letter-exchange' => "ex.faturamento",
    'x-dead-letter-routing-key' => "queue.errors"
]);

$queueManager->setQueue("queue.faturas", $dlk);
$queueManager->bind($queueManager->getQueueName(), $queueManager->getExchangeName(), $queueManager->getQueueName());



$pub = new Publisher();

$id = 0;
while($id < 10000){
    $id++;
    $msg = json_encode(["id"=>$id, "name"=> "Test_".time(), "status"=> "ok", "timestamp"=> date("Y-m-d H:i:s")]);
    $pub->send($queueManager, $msg);
    sleep(1);
}

$queueManager->getChannel()->close();
$queueManager->getConnection()->close();
