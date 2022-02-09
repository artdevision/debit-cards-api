<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\DTO;

final class CountryListResponseDto extends AbstractDto
{
    /**
     * @var CountryResponseDto[]
     */
    private array $items = [];

    /**
     * @param CountryResponseDto[] $items
     */
    public function setItems(array $items): void
    {
        $this->items[] = $items;
    }

    /**
     * @return CountryResponseDto[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
