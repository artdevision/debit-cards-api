<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\DTO;

final class CardCreateDto extends AbstractDto
{
    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $address = null;

    public ?string $city = null;

    public ?int $country_id = null;

    public ?string $phone = null;

    public ?string $currency = null;

    public ?float $balance = null;

    public ?string $pin = null;

    public ?string $status = null;
}
