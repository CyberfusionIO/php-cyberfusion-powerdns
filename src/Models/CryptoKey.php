<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Illuminate\Support\Arr;

class CryptoKey implements Requestable, Responsable
{
    private string $type = 'Cryptokey';

    public function __construct(
        private int $id = 0,
        private string $keyType = '',
        private bool $active = true,
        private bool $published = true,
        private string $dnsKey = '',
        private array $ds = [],
        private array $cds = [],
        private string $privateKey = '',
        private string $algorithm = '',
        private int $bits = 0,
        private int $flags = 0,
    ) {
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

    public function getPublicKey(): string
    {
        $keyParts = explode(' ', $this->dnsKey);

        return $keyParts[3] ?? '';
    }

    public function getProtocol(): int
    {
        $keyParts = explode(' ', $this->dnsKey);

        return (int) ($keyParts[1] ?? 0);
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

    public function getFlags(): int
    {
        return $this->flags;
    }

    public function setFlags(int $flags): void
    {
        $this->flags = $flags;
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
            bits: Arr::get($data, 'bits', 0),
            flags: Arr::get($data, 'flags', 0),
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
            'flags' => $this->flags,
        ];
    }
}
