<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitPubsub extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:pubsub
                            {--act=send : 发送OR接收.}
                            {--msg= : 发送消息.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ work模式DEMO';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('192.168.1.73', 5672, 'guest', 'guest');
        $channel    = $connection->channel();

        $channel->exchange_declare('logs', 'fanout', false, false, false);

        if ('send' == $this->option('act')) {
            $data = $this->option('msg');
            if (empty($data)) {
                $data = "info: Hello World!";
            }
            $msg = new AMQPMessage($data);

            $channel->basic_publish($msg, 'logs');

            echo ' [x] Sent ', $data, "\n";
        } else {
            list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

            $channel->queue_bind($queue_name, 'logs');

            echo " [*] Waiting for logs. To exit press CTRL+C\n";

            $callback = function ($msg) {
                echo ' [x] ', $msg->body, "\n";
            };

            $channel->basic_consume($queue_name, '', false, true, false, false, $callback);

            while (count($channel->callbacks)) {
                $channel->wait();
            }
        }

        $channel->close();
        $connection->close();
    }
}
