<?php
namespace app;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Wire\AMQPTable;

class QueueManager{

    private $host = "rabbitmq";
    private $port = 5672;
    private $user = "guest";
    private $pass = "guest";
    private $connection;
    private $channel;
    private $queueName;
    private $exchangeName;
    private $exchangeType;

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

    public function setQueue(string $queueName, ?AMQPTable $arguments)
    {
        $this->channel = $this->connection->channel();
        $this->channel->queue_declare($queueName, false, false, false, false, false, $arguments);
    
        $this->queueName = $queueName;
    }

    public function setExchange(string $exchangeName, string $type = 'direct')
    {
        $this->channel = $this->connection->channel();
        $this->channel->exchange_declare($exchangeName, $type, false, false, false);
        $this->exchangeName = $exchangeName;
    }

    public function bind(string $queueName, string $exchangeName, ?string $routingKey)
    {
        $this->channel = $this->connection->channel();
        $this->channel->queue_bind($queueName, $exchangeName, $routingKey);
        $this->exchangeName = $exchangeName;
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function getQueueName()
    {
        return $this->queueName;
    }

    public function getExchangeName()
    {
        return $this->exchangeName;
    }

    public function getExchangeType()
    {
        return $this->exchangeType;
    }


}
