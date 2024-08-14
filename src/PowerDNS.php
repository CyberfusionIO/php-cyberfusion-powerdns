<?php

namespace Cyberfusion\PowerDNS;

use Cyberfusion\PowerDNS\Endpoints\CryptoKeys;
use Cyberfusion\PowerDNS\Endpoints\Servers;
use Cyberfusion\PowerDNS\Endpoints\Zones;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class PowerDNS
{
    private const TIMEOUT = 180;

    private const VERSION = '1.0.0';

    private const USER_AGENT = 'cyberfusion-powerdns-client/' . self::VERSION;

    public function __construct(
        private readonly string $host,
        private readonly string $apiKey,
        private readonly ?Factory $client = null,
    ) {
    }

    public function httpClient(): PendingRequest
    {
        $pendingRequest = $this->client ?? Http::withUserAgent(self::USER_AGENT)->timeout(self::TIMEOUT);

        return $pendingRequest
            ->acceptJson()
            ->asJson()
            ->withHeaders(['X-API-Key' => $this->apiKey])
            ->baseUrl(sprintf('%s/api/v1/', $this->host));
    }

    public function cryptoKeys(): CryptoKeys
    {
        return new CryptoKeys($this);
    }

    public function servers(): Servers
    {
        return new Servers($this);
    }

    public function zones(): Zones
    {
        return new Zones($this);
    }
}
