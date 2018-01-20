<?php

namespace LaravelRequester\Providers;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use LaravelRequester\Requester;

class RequesterServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->singleton(
            Requester::class,
            $this->app->make(Kernel::class)
        );
    }
}