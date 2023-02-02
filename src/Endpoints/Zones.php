<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\Zone;
use Illuminate\Support\Arr;

class Zones extends Endpoint
{
    public function list(string $serverId): ?array
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s/zones', $serverId));

        $this->latestResponse = $response;

        if (! $response->successful()) {
            return null;
        }

        return array_map(
            fn (array $zone) => Zone::fromResponse($zone),
            $response->json()
        );
    }

    public function create(string $serverId, string $domain): ?Zone
    {
        $response = $this
            ->client
            ->post(sprintf('servers/%s/zones/%s', $serverId, $domain));

        $this->latestResponse = $response;

        if (! $response->successful()) {
            return null;
        }

        return Zone::fromResponse($response->json());
    }

    public function get(string $serverId, string $zoneId): ?Zone
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s/zones/%s', $serverId, $zoneId));

        $this->latestResponse = $response;

        if (! $response->successful()) {
            return null;
        }

        return Zone::fromResponse($response->json());
    }

    public function update(Zone $zone): bool
    {
        $response = $this
            ->client
            ->patch('zones', Arr::only($zone->toArray(), [
                'kind',
                'masters',
                'catalog',
                'account',
                'soa_edit',
                'soa_edit_api',
                'dnssec',
                'api_rectify',
                'nsec3param',
            ]));

        $this->latestResponse = $response;

        return $response->successful();
    }

    public function delete(string $serverId, string $zoneId): bool
    {
        $response = $this
            ->client
            ->delete(sprintf('servers/%s/zones/%s', $serverId, $zoneId));

        $this->latestResponse = $response;

        return $response->successful();
    }
}
