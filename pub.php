<?php

use app\Publisher;
use app\QueueManager;

require_once __DIR__."/vendor/autoload.php";

$queueManager = new QueueManager();
$queueManager->setChannel("primeiro_canal");

$pub = new Publisher();

$id = 0;
while($id < 10000){
    $id++;
    $msg = json_encode(["id"=>$id, "name"=> "Test_".time(), "status"=> "ok", "timestamp"=> date("Y-m-d H:i:s")]);
    $pub->send($msg, $queueManager);
    sleep(1);
}

$queueManager->getChannel()->close();
$queueManager->getConnection()->close();
