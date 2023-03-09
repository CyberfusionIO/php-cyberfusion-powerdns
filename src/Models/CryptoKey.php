<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Illuminate\Support\Arr;

class CryptoKey implements Responsable, Requestable
{
    private string $type = 'Cryptokey';

    private int $id;

    private string $keyType;

    private bool $active;

    private bool $published;

    private string $dnsKey;

    private array $ds;

    private array $cds;

    private string $privateKey;

    private string $algorithm;

    private int $bits;

    public function __construct(
        int $id = 0,
        string $keyType = '',
        bool $active = true,
        bool $published = true,
        string $dnsKey = '',
        array $ds = [],
        array $cds = [],
        string $privateKey = '',
        string $algorithm = '',
        int $bits = 0
    ) {
        $this->id = $id;
        $this->keyType = $keyType;
        $this->active = $active;
        $this->published = $published;
        $this->dnsKey = $dnsKey;
        $this->ds = $ds;
        $this->cds = $cds;
        $this->privateKey = $privateKey;
        $this->algorithm = $algorithm;
        $this->bits = $bits;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): CryptoKey
    {
        $this->id = $id;

        return $this;
    }

    public function getKeyType(): string
    {
        return $this->keyType;
    }

    public function setKeyType(string $keyType): CryptoKey
    {
        $this->keyType = $keyType;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): CryptoKey
    {
        $this->active = $active;

        return $this;
    }

    public function isPublished(): bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): CryptoKey
    {
        $this->published = $published;

        return $this;
    }

    public function getDnsKey(): string
    {
        return $this->dnsKey;
    }

    public function setDnsKey(string $dnsKey): CryptoKey
    {
        $this->dnsKey = $dnsKey;

        return $this;
    }

    public function getDs(): array
    {
        return $this->ds;
    }

    public function setDs(array $ds): CryptoKey
    {
        $this->ds = $ds;

        return $this;
    }

    public function getCds(): array
    {
        return $this->cds;
    }

    public function setCds(array $cds): CryptoKey
    {
        $this->cds = $cds;

        return $this;
    }

    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    public function setPrivateKey(string $privateKey): CryptoKey
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    public function getAlgorithm(): string
    {
        return $this->algorithm;
    }

    public function setAlgorithm(string $algorithm): CryptoKey
    {
        $this->algorithm = $algorithm;

        return $this;
    }

    public function getBits(): int
    {
        return $this->bits;
    }

    public function setBits(int $bits): CryptoKey
    {
        $this->bits = $bits;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            id: Arr::get($data, 'id', ''),
            keyType: Arr::get($data, 'keytype', ''),
            active: Arr::get($data, 'active', true),
            published: Arr::get($data, 'published', true),
            dnsKey: Arr::get($data, 'dnskey', ''),
            ds: Arr::get($data, 'ds', []),
            cds: Arr::get($data, 'cds', []),
            privateKey: Arr::get($data, 'privatekey', ''),
            algorithm: Arr::get($data, 'algorithm', ''),
            bits: Arr::get($data, 'bits', 0)
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'keytype' => $this->keyType,
            'active' => $this->active,
            'published' => $this->published,
            'dnskey' => $this->dnsKey,
            'ds' => $this->ds,
            'cds' => $this->cds,
            'privatekey' => $this->privateKey,
            'algorithm' => $this->algorithm,
            'bits' => $this->bits,
        ];
    }
}
