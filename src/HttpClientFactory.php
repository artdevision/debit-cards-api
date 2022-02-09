<?php

namespace Artdevision\DebitCardsApi;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Psr\Http\Message\RequestInterface;

class HttpClientFactory
{
    /**
     * @param string $auth_key
     * @return Client
     */
    public static function factory(string $auth_key): Client
    {
        $stack = new HandlerStack();
        $stack->setHandler(new CurlHandler());

        $stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($auth_key) {
            return $request
                ->withHeader('AUTH-KEY', $auth_key)
                ->withHeader('Accept', 'application/json')
                ->withHeader('Content-Type', 'application/json');
        }));

        return new Client([
            'base_uri' => 'http://localhost',
            'handler' => $stack
        ]);
    }
}
