<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\DTO;

final class CountryResponseDto extends AbstractDto
{
    public int $id;

    public ?string $code = null;

    public ?string $name = null;
}
