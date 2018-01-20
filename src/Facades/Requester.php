<?php

namespace LaravelRequester\Facades;


use Illuminate\Support\Facades\Facade;

class Requester extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \LaravelRequester\Requester::class;
    }
}