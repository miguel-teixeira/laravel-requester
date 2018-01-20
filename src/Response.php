<?php

namespace LaravelRequester;

use Symfony\Component\HttpFoundation\Response as  HttpResponse;

class Response
{
    protected $response;

    public function __construct(HttpResponse $response)
    {
        $this->response = $response;
    }

    public function getContent()
    {
        return $this->response->getContent();
    }

    public function getHeaders()
    {
        return $this->response->headers;
    }

    public function json()
    {
        return $this->decodeResponseJson();
    }

    public function decodeResponseJson()
    {
        return json_decode($this->getContent(), true);
    }

    public function dump()
    {
        dump($this->response->getContent());

        return $this;
    }
}