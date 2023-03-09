<?php

namespace Cyberfusion\PowerDNS;

use Cyberfusion\PowerDNS\Endpoints\CryptoKeys;
use Cyberfusion\PowerDNS\Endpoints\Servers;
use Cyberfusion\PowerDNS\Endpoints\Zones;

class PowerDNS
{
    public function __construct(protected readonly Client $client)
    {
    }

    public function cryptoKeys(): CryptoKeys
    {
        return new CryptoKeys($this->client);
    }

    public function servers(): Servers
    {
        return new Servers($this->client);
    }

    public function zones(): Zones
    {
        return new Zones($this->client);
    }
}
