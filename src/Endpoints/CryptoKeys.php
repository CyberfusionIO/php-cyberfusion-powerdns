<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\CryptoKey;
use Illuminate\Http\Client\RequestException;

class CryptoKeys extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function get(string $serverId, string $zoneId): ?CryptoKey
    {
        $response = $this
            ->powerDNS
            ->httpClient()
            ->get(sprintf('servers/%s/zones/%s/cryptokeys', $serverId, $zoneId))
            ->throw();

        return CryptoKey::fromResponse($response->json());
    }
}
