<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/28
 * Time: 18:09
 */

namespace App\Http\Controllers\Api\V1;

class ProtobufController
{
    public function send(){
        $service_name = 'go.micro.srv.greeter';
        $service = self::getService($service_name);
        $hostname = $service->Address.':'.$service->Port;
        $opts = [
            'credentials' => \Grpc\ChannelCredentials::createInsecure()
        ];

//        // 50051端口随意是什么都可以，不过要与服务端监听的端口一致
//        $client = new \Hello\SayClient('127.0.0.1:50051', [
//            'credentials' => \Grpc\ChannelCredentials::createInsecure(),
//        ]);

        $client = new \Hello\SayClient($hostname, $opts);
        $request = new \Hello\Request();
        $request->setName('hahahaha');
        list($reply, $status) = $client->Hello($request)->wait();
        echo $reply->getMsg();exit;

    }

    /**
     * @param string $service_name
     * @return object
     * @throws \Exception
     */
    public static function getService(string $service_name)
    {
        $consul_host = 'http://192.168.1.67:8500';

        //guzzle request options
        $options = [
            'base_uri' => $consul_host,
            'connect_timeout' => 3,
            'timeout' => 3,
        ];

        /**
         * @var \SensioLabs\Consul\Services\Health $h
         * @var \SensioLabs\Consul\ConsulResponse $resp
         */
        $h = (new \SensioLabs\Consul\ServiceFactory($options))->get('health');
        $resp = $h->service($service_name);
        $services = \json_decode($resp->getBody());
        if (!$services) {
            throw new \Exception('service '.$service_name.' not exists');
        }

        foreach ($services as $service) {
            if ($service->Service->Service != $service_name) {
                continue;
            }

            $del = false;
            foreach ($service->Checks as $check) {
                if ($check->Status == 'critical') {
                    $del = true;
                    break;
                }
            }
            if ($del) {
                continue;
            }
            //$host = $service->Service->Address.':'.$service->Service->Port;
            return $service->Service;
        }

        throw new \Exception('service '.$service_name.' not available');
    }
}