<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\Server;
use Illuminate\Http\Client\RequestException;

class Servers extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function list(): ?array
    {
        $response = $this
            ->client
            ->get('servers')
            ->throw();

        return array_map(
            fn (array $server) => Server::fromResponse($server),
            $response->json()
        );
    }

    /**
     * @throws RequestException
     */
    public function get(string $serverId): ?Server
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s', $serverId))
            ->throw();

        return Server::fromResponse($response->json());
    }
}
