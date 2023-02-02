<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Illuminate\Support\Arr;

class TSIGKey implements Responsable, Requestable
{
    private string $name;

    private int $id;

    private string $algorithm;

    private string $key;

    private string $type = 'TSIGKey';

    public function __construct(
        string $name = '',
        int $id = 0,
        string $algorithm = '',
        string $key = ''
    ) {
        $this
            ->setName($name)
            ->setId($id)
            ->setAlgorithm($algorithm)
            ->setKey($key);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TSIGKey
    {
        $this->name = $name;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): TSIGKey
    {
        $this->id = $id;

        return $this;
    }

    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    public function setAlgorithm(string $algorithm): TSIGKey
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): TSIGKey
    {
        $this->key = $key;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            name: Arr::get($data, 'name', ''),
            id: Arr::get($data, 'id', 0),
            algorithm: Arr::get($data, 'algorithm', ''),
            key: Arr::get($data, 'key', ''),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'id' => $this->id,
            'algorithm' => $this->algorithm,
            'key' => $this->key,
            'type' => $this->type,
        ];
    }
}
