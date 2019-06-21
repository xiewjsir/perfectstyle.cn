<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmqSubscribe extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emq:subscribe';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '订阅EMQTT消息';

    public function handle()
    {
        $server    = "192.168.1.62";
        $port      = 1883;
        $username  = "admin";
        $password  = "public";
        $client_id = "clientid183778762"; // make sure this is unique for connecting to sever - you could use uniqid()
        $mqtt      = new \Bluerhinos\phpMQTT($server, $port, $client_id);

        if (!$mqtt->connect(true, NULL, $username, $password)) {
            exit(1);
        }

        $topics['helloworld/publishtest'] = array("qos" => 0, "function"=>[$this, "callback"]);
        $mqtt->subscribe($topics, 0);

        while ($mqtt->proc()) {

        }

        $mqtt->close();

        echo "all done!" . PHP_EOL;
    }

    public function callback($topic = null, $msg = null)
    {
        echo "Msg Recieved: " . date("r") . "\n";
        echo "Topic: {$topic}\n\n";
        echo "\t$msg\n\n";
    }

}
