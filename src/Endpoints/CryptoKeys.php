<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\CryptoKey;

class CryptoKeys extends Endpoint
{
    public function get(string $serverId, string $zoneId): ?CryptoKey
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s/zones/%s/cryptokeys', $serverId, $zoneId));

        $this->latestResponse = $response;

        if (! $response->successful()) {
            return null;
        }

        return CryptoKey::fromResponse($response->json());
    }
}
