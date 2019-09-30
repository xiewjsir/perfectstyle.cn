<?php


namespace App\Contracts\Foundation;

use Monolog\Handler\AbstractProcessingHandler;
use App\Facades\ElasticSearchClient;

class ElasticSearchLogHandler extends AbstractProcessingHandler
{
    protected function write(array $record)
    {
        if ($record['level'] >= 200) {
            ElasticSearchClient::addDocument($record);
        }
    }
}