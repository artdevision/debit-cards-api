<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\Request;

use Artdevision\DebitCardsApi\DTO\AbstractDto;
use Artdevision\DebitCardsApi\DTO\CardCreateDto;
use Artdevision\DebitCardsApi\DTO\CardResponseDto;
use Artdevision\DebitCardsApi\Exception\DebitCardResponseException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;

final class CardRequestService extends BaseRequestService
{
    /**
     * @param int $id
     * @return CardResponseDto
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function one(int $id): CardResponseDto
    {
        $response = $this->get(sprintf('/cards/%s', $id));
        return CardResponseDto::fromJson((string) $response->getBody());
    }

    /**
     * @param int $id
     * @return string
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function pin(int $id): string
    {
        $response = $this->get(sprintf('/cards/%s/pin', $id));
        $dto = CardResponseDto::fromJson((string) $response->getBody());
        return $dto->pin;
    }

    /**
     * @param int $id
     * @return float
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function balance(int $id): float
    {
        $response = $this->get(sprintf('/cards/%s/balance', $id));
        $dto = CardResponseDto::fromJson((string) $response->getBody());
        return $dto->balance;
    }

    /**
     * @param CardCreateDto $dto
     * @return CardResponseDto
     * @throws DebitCardResponseException
     * @throws ClientExceptionInterface
     */
    public function create(CardCreateDto $dto): CardResponseDto
    {
        $response = $this->post('/cards/create', $dto->toJson());
        return CardResponseDto::fromJson((string) $response->getBody());
    }

    /**
     * @param int $id
     * @param CardCreateDto $dto
     * @return CardResponseDto
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function update(int $id, CardCreateDto $dto): CardResponseDto
    {
        $response = $this->post(sprintf('/cards/%s/update', $id), $dto->toJson());
        return CardResponseDto::fromJson((string) $response->getBody());
    }

    /**
     * @param int $id
     * @return bool
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function active(int $id): bool
    {
        $response = $this->post(sprintf('/cards/%s/update', $id));
        return $response->getStatusCode() === 204;
    }

    /**
     * @param int $id
     * @return bool
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     */
    public function deactivate(int $id): bool
    {
        $response = $this->post(sprintf('/cards/%s/deactivate', $id));
        return $response->getStatusCode() === 204;
    }
}
