<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Illuminate\Support\Arr;

class CacheFlushResult implements Responsable, Requestable
{
    private int $count;

    private string $result;

    public function __construct(
        int $count = 0,
        string $result = ''
    ) {
        $this
            ->setCount($count)
            ->setResult($result);
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): CacheFlushResult
    {
        $this->count = $count;

        return $this;
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function setResult(string $result): CacheFlushResult
    {
        $this->result = $result;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            count: Arr::get($data, 'count', 0),
            result: Arr::get($data, 'result', '')
        );
    }

    public function toArray(): array
    {
        return [
            'count' => $this->count,
            'result' => $this->result,
        ];
    }
}
