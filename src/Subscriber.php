<?php
namespace app;

use PhpAmqpLib\Message\AMQPMessage;

class Subscriber{

    private function callback()
    {
        return function (AMQPMessage $msg) {

            echo ' [x] Recebido: ', $msg->getBody(), "\n";
            
            $data = json_decode($msg->getBody(), true);
            $fail = ($data["id"] % 10) == 0;
            if($fail){
                echo "ID: ".$data["id"]." Failed!\n";
                $msg->reject(false);
            }else{
                $msg->ack();
            }
            
            
            
        };
    }
    

    public function get(?string $queueName)
    {
        $queueManager = new QueueManager();
        $channel = $queueManager->getConnection()->channel();
        
        echo " [*] Waiting for messages. To exit press CTRL+C\n";

        $channel->basic_consume($queueName, '', false, false, false, false, $this->callback());

        try {
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
