<?php
use app\Subscriber;

require_once __DIR__."/vendor/autoload.php";

$sub = new Subscriber();
$sub->get("primeiro_canal");
