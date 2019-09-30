<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ElasticSearchClient extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'App\Contracts\ElasticSearchClient';
    }
}