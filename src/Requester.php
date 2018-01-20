<?php

namespace LaravelRequester;

use Illuminate\Support\Str;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Requester
{
    protected $kernel;

    protected $requests = [];

    protected $responses = [];

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function request(Request $request)
    {
        $this->requests[] = $this->makeSymfonyRequest($request);

        return $this;
    }

    public function submit()
    {
        foreach ($this->requests as $symfonyRequest) {
            $response = $this->kernel->handle(
                $request = HttpRequest::createFromBase($symfonyRequest)
            );

            $this->followRedirects($response);

            $this->kernel->terminate($request, $response);

            $this->responses[] = new Response($response);
        }

        return $this->responses;
    }

    protected function makeSymfonyRequest(Request $request)
    {
        return SymfonyRequest::create(
            $this->prepareUrlForRequest($request->getUri()),
            $request->getMethod(),
            $request->getParameters(),
            $request->getCookies(),
            $request->getFiles(),
            $request->getServerVariables(),
            $request->getContent()
        );
    }

    protected function followRedirects($response)
    {
        while ($response->isRedirect()) {
            $response = $this->get($response->headers->get('Location'));
        }

        $this->followRedirects = false;

        return $response;
    }

    protected function prepareUrlForRequest($uri)
    {
        if (Str::startsWith($uri, '/')) {
            $uri = substr($uri, 1);
        }

        if (! Str::startsWith($uri, 'http')) {
            $uri = config('app.url').'/'.$uri;
        }

        return trim($uri, '/');
    }

}