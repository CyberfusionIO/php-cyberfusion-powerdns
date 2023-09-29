<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Illuminate\Support\Arr;

class Metadata implements Requestable, Responsable
{
    private string $kind;

    private array $metadata;

    public function __construct(
        string $kind = '',
        array $metadata = []
    ) {
        $this
            ->setKind($kind)
            ->setMetadata($metadata);
    }

    public function getKind(): string
    {
        return $this->kind;
    }

    public function setKind(string $kind): Metadata
    {
        $this->kind = $kind;

        return $this;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }

    public function setMetadata(array $metadata): Metadata
    {
        $this->metadata = $metadata;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            kind: Arr::get($data, 'kind', ''),
            metadata: Arr::get($data, 'metdata', '')
        );
    }

    public function toArray(): array
    {
        return [
            'kind' => $this->kind,
            'metadata' => $this->metadata,
        ];
    }
}
