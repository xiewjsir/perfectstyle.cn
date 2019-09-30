<?php


namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;

class EsController extends Controller
{
    public $client = null;

    public function __construct()
    {
        $hosts = config('elasticsearch.hosts');
        $this->client = ClientBuilder::create()->setHosts($hosts)->build(); // 实例化一个客户端
    }

    //创建
    public function index()
    {
        $params = [
            'index' => 'perfectstyle.cn',
            'type'  => 'perfect',
            'id'    => '1',
            'body'  => ['testField' => '这是一个ES测试内容']
        ];

        $response = $this->client->index($params);
        print_r($response);
    }

    public function search()
    {
        $params = [
            'index' => 'perfectstyle.cn',
            'type' => 'perfect',
            'body' => [
                'query' => [
                    'match' => [
                        'testField' => '测试'
                    ]
                ]
            ]
        ];

        $response = $this->client->search($params);
        print_r($response);
    }
}