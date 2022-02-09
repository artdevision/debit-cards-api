<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\Request;

use Artdevision\DebitCardsApi\DTO\AbstractDto;
use Artdevision\DebitCardsApi\Exception\DebitCardResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class BaseRequestService implements ClientInterface
{
    private Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param $endpoint
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function get($endpoint): ResponseInterface
    {
        return $this->sendRequest(new Request('GET', $endpoint));
    }

    /**
     * @param $endpoint
     * @param string|null $data
     * @return ResponseInterface
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function post($endpoint, string $data = null): ResponseInterface
    {
        return $this->sendRequest(new Request('POST', $endpoint, null, $data));
    }

    /**
     * @throws DebitCardResponseException
     * @throws ClientExceptionInterface
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $response = $this->client->sendRequest($request);
        if (substr((string) $response->getStatusCode(), 0, 2) !== '20') {
            throw new DebitCardResponseException($response->getBody());
        }

        return $response;
    }
}
