<?php

use Artdevision\DebitCardsApi\DTO\CardCreateDto;
use Artdevision\DebitCardsApi\DTO\CountryListResponseDto;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

final class DtoTest extends TestCase
{
    private array $cardData = [];

    private array $countryData = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->cardData = [
            'first_name' => 'Name',
            'last_name' => 'Name',
        ];

        $this->countryData = [
            [
                'id' => 1,
                'code' => 'RU',
                'name' => 'Russia'
            ],
            [
                'id' => 2,
                'code' => 'IL',
                'name' => 'Israel'
            ],
        ];
    }

    /**
     * @throws ExceptionInterface
     */
    public function testFromArray()
    {
        /** @var CardCreateDto $dto */
        $dto = CardCreateDto::fromArray($this->cardData);

        $this->assertInstanceOf(CardCreateDto::class, $dto);
        $this->assertNotNull($dto->first_name);
    }

    /**
     * @throws ExceptionInterface
     */
    public function testToJson()
    {
        $dto = CardCreateDto::fromArray($this->cardData);

        $this->assertIsString($dto->toJson());
        $this->assertStringContainsString('first_name', $dto->toJson());
    }

    /**
     * @throws ExceptionInterface
     */
    public function testToArray()
    {
        $dto = CardCreateDto::fromArray($this->cardData);

        $this->assertIsArray($dto->toArray());
        $this->assertArrayHasKey('first_name', $dto->toArray());
    }

    /**
     * @throws ExceptionInterface
     */
    public function testArrayList()
    {
        /** @var CountryListResponseDto $dto */
        $dto = CountryListResponseDto::fromArray(['items' => $this->countryData]);

        $this->assertIsArray($dto->getItems());
        $this->assertNotEmpty($dto->getItems());
    }
}
