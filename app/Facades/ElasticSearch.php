<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ElasticSearch extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'elasticsearchservice';
    }
}
