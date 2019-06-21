<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitRouting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:routing
                            {--act=send : 发送OR接收.}
                            {--severity= : 日志级别,默认info.}
                            {--msg= : 发送消息.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ routing模式DEMO';

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

        $channel->exchange_declare('direct_logs', 'direct', false, false, false);

        if ('send' == $this->option('act')) {

            $severity = $this->option('severity') ? $this->option('severity') : 'info';
            $data = $this->option('msg');
            if (empty($data)) {
                $data = "Hello World!";
            }

            $msg = new AMQPMessage($data);
            $channel->basic_publish($msg, 'direct_logs', $severity);
            echo ' [x] Sent ', $severity, ':', $data, "\n";
        } else {
            list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);

            $severities = ['warning','error'];
            foreach ($severities as $severity) {
                $channel->queue_bind($queue_name, 'direct_logs', $severity);
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
