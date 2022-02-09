<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\Request;

use Artdevision\DebitCardsApi\DTO\CountryListResponseDto;
use Artdevision\DebitCardsApi\DTO\CountryResponseDto;
use Artdevision\DebitCardsApi\Exception\DebitCardResponseException;
use Psr\Http\Client\ClientExceptionInterface;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class CountriesRequestService extends BaseRequestService
{
    /**
     * @return CountryListResponseDto
     * @throws ClientExceptionInterface
     * @throws DebitCardResponseException
     * @throws ExceptionInterface
     */
    public function all(): CountryListResponseDto
    {
        $response = $this->get('/countries');
        return CountryListResponseDto::fromArray(['items' => json_decode((string) $response->getBody(), true)]);
    }

    /**
     * @param int $id
     * @return CountryResponseDto
     * @throws DebitCardResponseException
     * @throws ClientExceptionInterface
     */
    public function one(int $id): CountryResponseDto
    {
        $response = $this->get(sprintf('/countries/%s', $id));
        return CountryResponseDto::fromJson((string) $response->getBody());
    }
}
