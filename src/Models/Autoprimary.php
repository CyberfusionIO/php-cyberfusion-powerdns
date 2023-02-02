<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Illuminate\Support\Arr;

class Autoprimary implements Responsable, Requestable
{
    private string $ip;

    private string $nameserver;

    private string $account;

    public function __construct(
        string $ip = '',
        string $nameserver = '',
        string $account = ''
    ) {
        $this
            ->setIp($ip)
            ->setNameserver($nameserver)
            ->setAccount($account);
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): Autoprimary
    {
        $this->ip = $ip;

        return $this;
    }

    public function getNameserver(): string
    {
        return $this->nameserver;
    }

    public function setNameserver(string $nameserver): Autoprimary
    {
        $this->nameserver = $nameserver;

        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setAccount(string $account): Autoprimary
    {
        $this->account = $account;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            ip: Arr::get($data, 'ip'),
            nameserver: Arr::get($data, 'nameserver'),
            account: Arr::get($data, 'account')
        );
    }

    public function toArray(): array
    {
        return [
            'ip' => $this->ip,
            'nameserver' => $this->nameserver,
            'account' => $this->account,
        ];
    }
}
