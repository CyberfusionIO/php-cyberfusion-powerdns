<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\CryptoKey;
use Illuminate\Http\Client\RequestException;

class CryptoKeys extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function get(string $serverId, string $zoneId): array
    {
        $response = $this
            ->powerDNS
            ->httpClient()
            ->get(sprintf('servers/%s/zones/%s/cryptokeys', $serverId, $zoneId))
            ->throw();

        return array_map(
            fn(array $cryptoKey) => CryptoKey::fromResponse($cryptoKey),
            $response->json() ?? [],
        );
    }
}
