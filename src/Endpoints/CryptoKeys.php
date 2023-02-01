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
        if (! $response->successful()) {
            return null;
        }

        return CryptoKey::fromResponse(json_decode($response->body(), false, 512, JSON_THROW_ON_ERROR));
    }
}
