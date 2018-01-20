<?php

namespace LaravelRequester;


class Request
{
    protected $uri;

    protected $method;

    protected $parameters = [];

    protected $cookies = [];

    protected $files = [];

    protected $serverVariables = [];

    protected $content = null;

    public function __construct($uri, $method, $content = null)
    {
        $this->uri = $uri;

        $this->method = $method;

        $this->content = $content;
    }

    public function parameters(array $parameters)
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function cookies(array $cookies)
    {
        $this->cookies = $cookies;

        return $this;
    }

    public function files(array $files)
    {
        $this->files = $files;


        return $this;
    }

    public function serverVariables($serverVariables)
    {
        $this->serverVariables = $serverVariables;

        return $this;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getParameters()
    {
        return $this->parameters;
    }

    public function getCookies()
    {
        return $this->cookies;
    }

    public function getFiles()
    {
        return $this->files;
    }

    public function getServerVariables()
    {
        return $this->serverVariables;
    }

    public function getContent()
    {
        return $this->content;
    }


}