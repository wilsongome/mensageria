<?php
namespace app;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class Subscriber{

    private function response()
    {
        return function (AMQPMessage $msg) {
            echo ' [x] Recebido: ', $msg->getBody(), "\n";
        };
    }
    

    public function get(string $channelName)
    {
        $queueManager = new QueueManager();
        $channel = $queueManager->getConnection()->channel();
        
        $channel->queue_declare($channelName, false, false, false, false);
        
        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $channel->basic_consume($channelName, '', false, true, false, false, $this->response());

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
