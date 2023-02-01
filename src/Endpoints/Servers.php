<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\Server;
use stdClass;

class Servers extends Endpoint
{
    public function list(): ?array
    {
        $response = $this
            ->client
            ->get('servers');
        if (! $response->successful()) {
            return null;
        }

        return array_map(
            fn (stdClass $zone) => Server::fromResponse($zone),
            json_decode($response->body(), false, 512, JSON_THROW_ON_ERROR)
        );
    }

    public function get(string $serverId): ?Server
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s', $serverId));
        if (! $response->successful()) {
            return null;
        }

        return Server::fromResponse(json_decode($response->body(), false, 512, JSON_THROW_ON_ERROR));
    }
}
