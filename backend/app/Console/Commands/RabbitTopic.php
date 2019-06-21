<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitTopic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:topic
                            {--act=send : 发送OR接收.}
                            {--routing_key=anonymous.info : 路由KEY，默认anonymous.info.}
                            {--msg= : 发送消息.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ topic模式DEMO';

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

        $channel->exchange_declare('topic_logs', 'topic', false, false, false);

        if ('send' == $this->option('act')) {
            $routing_key = $this->option('routing_key');

            $data = $this->option('msg');
            if (empty($data)) {
                $data = "Hello World!";
            }

            $msg = new AMQPMessage($data);

            $channel->basic_publish($msg, 'topic_logs', $routing_key);

            echo ' [x] Sent ', $routing_key, ':', $data, "\n";
        } else {
            list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

            $binding_keys = ['#','ern.*','*.critical'];
            foreach ($binding_keys as $binding_key) {
                $channel->queue_bind($queue_name, 'topic_logs', $binding_key);
            }

            echo " [*] Waiting for logs. To exit press CTRL+C\n";

            $callback = function ($msg) {
                echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";
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
