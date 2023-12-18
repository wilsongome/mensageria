<?php
namespace app;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class QueueManager{

    private $host = "rabbitmq";
    private $port = 5672;
    private $user = "guest";
    private $pass = "guest";
    private $connection;
    private $channel;
    private $channelName;

    public function __construct()
    {
        $this->setConnection();
    }

    private function setConnection()
    {
        $this->connection = new AMQPStreamConnection($this->host, $this->port, $this->user, $this->pass);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function setChannel(string $channelName)
    {
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($channelName, false, false, false, false);
        $this->channelName = $channelName;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function getChannelName()
    {
        return $this->channelName;
    }


}
