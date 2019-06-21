<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:hello
                            {--act=send :发送OR接收}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ 简单模式DEMO';

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
        $channel->queue_declare('hello', false, false, false, false);

        if ('send' == $this->option('act')) {
            $msg = new AMQPMessage('Hello World!');
            $channel->basic_publish($msg, '', 'hello');

            $this->info("[x] Sent 'Hello World!'");
        } else {
            $this->info("[*] Waiting for messages. To exit press CTRL+C");

            $callback = function ($msg) {
                $this->info("[x] Received {$msg->body}");
            };

            $channel->basic_consume('hello', '', false, true, false, false, $callback);

            while (count($channel->callbacks)) {
                $channel->wait();
            }
        }

        $channel->close();
        $connection->close();
    }
}
