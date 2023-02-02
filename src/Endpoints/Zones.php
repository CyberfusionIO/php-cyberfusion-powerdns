<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\RRSet;
use Cyberfusion\PowerDNS\Models\Zone;
use Illuminate\Support\Arr;

class Zones extends Endpoint
{
    public function list(string $serverId): ?array
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s/zones', $serverId));
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
        if (! $response->successful()) {
            return null;
        }

        return Zone::fromResponse($response->json());
    }

    public function updateRrsets(string $serverId, string $zoneId, array $rrsets): bool
    {
        return $this
            ->client
            ->patch(sprintf('servers/%s/zones/%s', $serverId, $zoneId), [
                'rrsets' => array_map(
                    fn (RRSet $rrset) => $rrset->toArray(),
                    $rrsets
            )])
            ->successful();
    }

    public function updateZoneData(string $serverId, Zone $zone): bool
    {
        return $this
            ->client
            ->put(sprintf('servers/%s/zones/%s', $serverId, $zone->getId()), Arr::only($zone->toArray(), [
                'kind',
                'masters',
                'catalog',
                'account',
                'soa_edit',
                'soa_edit_api',
                'dnssec',
                'api_rectify',
                'nsec3param',
            ]))
            ->successful();
    }

    public function delete(string $serverId, string $zoneId): bool
    {
        return $this
            ->client
            ->delete(sprintf('servers/%s/zones/%s', $serverId, $zoneId))
            ->successful();
    }
}
