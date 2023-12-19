<?php
namespace app;

use PhpAmqpLib\Message\AMQPMessage;

class Publisher{

    public function send(QueueManager $queueManager, string $messageText)
    {

        $message = new AMQPMessage($messageText);
        $queueManager->getChannel()->basic_publish
        (
            $message,
            $queueManager->getExchangeName(),
            $queueManager->getQueueName()
        );
        
        echo " [x] Sent  '$messageText'\n";

    }


}
