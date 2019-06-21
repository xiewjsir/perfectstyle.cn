<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitWork extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbit:work
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

        $channel->queue_declare('task_queue', false, true, false, false);

        if ('send' == $this->option('act')) {
            $data = $this->option('msg');
            if (empty($data)) {
                $data = "Hello World!";
            }
            $msg = new AMQPMessage(
                $data,
                array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT)
            );

            $channel->basic_publish($msg, '', 'task_queue');

            echo ' [x] Sent ', $data, "\n";
        } else {
            echo " [*] Waiting for messages. To exit press CTRL+C\n";

            $callback = function ($msg) {
                echo ' [x] Received ', $msg->body, "\n";
                sleep(substr_count($msg->body, '.'));
                echo " [x] Done\n";
                $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
            };

            $channel->basic_qos(null, 1, null);
            $channel->basic_consume('task_queue', '', false, false, false, false, $callback);

            while (count($channel->callbacks)) {
                $channel->wait();
            }
        }

        $channel->close();
        $connection->close();
    }
}
