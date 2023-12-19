<?php
use app\Subscriber;

require_once __DIR__."/vendor/autoload.php";

$queueName = isset($argv[1]) ? $argv[1] : null;

if(!$queueName){
    die("Erro: Informe o nome da fila que deseja consumir\n");
}

$sub = new Subscriber();
$sub->get($queueName);
