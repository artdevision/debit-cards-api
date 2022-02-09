<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi;

use Artdevision\DebitCardsApi\Request\CardRequestService;
use Artdevision\DebitCardsApi\Request\CountriesRequestService;
use GuzzleHttp\Client;

class DebitCards
{
    public CountriesRequestService $counties;

    public CardRequestService $cards;

    public function __construct(string $auth_key)
    {
        $client = HttpClientFactory::factory($auth_key);

        $this->counties = new CountriesRequestService($client);
        $this->cards = new CardRequestService($client);
    }
}
