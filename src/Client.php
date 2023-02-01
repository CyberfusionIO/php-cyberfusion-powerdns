<?php

namespace Cyberfusion\PowerDNS;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;

class Client extends Factory
{
    private const TIMEOUT = 180;

    private const VERSION = '1.0.0';

    private const USER_AGENT = 'cyberfusion-powerdns-client/'.self::VERSION;

    public function __construct(private readonly string $host, private readonly string $apiKey)
    {
        parent::__construct();
    }

    protected function newPendingRequest(): PendingRequest
    {
        return parent::newPendingRequest()
            ->acceptJson()
            ->asJson()
            ->withHeaders(['X-API-Key' => $this->apiKey])
            ->baseUrl(sprintf('%s/api/v1/', $this->host))
            ->timeout(self::TIMEOUT)
            ->withUserAgent(self::USER_AGENT);
    }
}
