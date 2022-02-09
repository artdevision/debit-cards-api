<?php

declare(strict_types=1);

namespace Artdevision\DebitCardsApi\DTO;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractDto
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    public function toJson(): string
    {
        return $this->serializer->serialize($this, 'json');
    }

    /**
     * @throws ExceptionInterface
     */
    public function toArray(): array
    {
        return $this->serializer->normalize($this);
    }

    /**
     * @param array $params
     * @return mixed
     * @throws ExceptionInterface
     */
    public static function fromArray(array $params): self
    {
        $serializer = new Serializer([
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                new ReflectionExtractor()
            )
        ]);
        return $serializer->denormalize($params, static::class);
    }

    /**
     * @param string $data
     * @return static
     */
    public static function fromJson(string $data): self
    {
        $serializer = new Serializer(
            [
                new ObjectNormalizer(
                    null,
                    null,
                    null,
                    new ReflectionExtractor()
                )
            ],
            [
                new JsonEncoder()
            ]
        );
        return $serializer->deserialize($data, static::class, 'json');
    }
}
