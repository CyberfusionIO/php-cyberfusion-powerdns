<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\Server;

class Servers extends Endpoint
{
    public function list(): ?array
    {
        $response = $this
            ->client
            ->get('servers');

        $this->latestResponse = $response;

        if (! $response->successful()) {
            return null;
        }

        return array_map(
            fn (array $server) => Server::fromResponse($server),
            $response->json()
        );
    }

    public function get(string $serverId): ?Server
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s', $serverId));

        $this->latestResponse = $response;

        if (! $response->successful()) {
            return null;
        }

        return Server::fromResponse($response->json());
    }
}
