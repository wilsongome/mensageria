<?php
namespace app;

use PhpAmqpLib\Message\AMQPMessage;

class Publisher{

    public function send(string $messageText, QueueManager $queueManager)
    {

        $message = new AMQPMessage($messageText);
        $queueManager->getChannel()->basic_publish($message, '', $queueManager->getChannelName());
        
        echo " [x] Sent '$messageText'\n";

    }


}
