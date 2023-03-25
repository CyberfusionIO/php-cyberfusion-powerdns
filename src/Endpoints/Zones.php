<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Models\RRSet;
use Cyberfusion\PowerDNS\Models\Zone;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;

class Zones extends Endpoint
{
    /**
     * @throws RequestException
     */
    public function list(string $serverId): ?array
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s/zones', $serverId))
            ->throw();

        return array_map(
            fn (array $zone) => Zone::fromResponse($zone),
            $response->json()
        );
    }

    /**
     * @throws RequestException
     */
    public function create(string $serverId, string $domain): ?Zone
    {
        $zone = new Zone(name: $domain);

        $response = $this
            ->client
            ->post(sprintf('servers/%s/zones', $serverId), $zone->toArray())
            ->throw();

        return Zone::fromResponse($response->json());
    }

    /**
     * @throws RequestException
     */
    public function get(string $serverId, string $zoneId): ?Zone
    {
        $response = $this
            ->client
            ->get(sprintf('servers/%s/zones/%s?rrsets=true', $serverId, $zoneId))
            ->throw();

        return Zone::fromResponse($response->json());
    }

    /**
     * @throws RequestException
     */
    public function updateRrsets(string $serverId, string $zoneId, array $rrsets): void
    {
        $this
            ->client
            ->patch(sprintf('servers/%s/zones/%s', $serverId, $zoneId), [
                'rrsets' => array_map(
                    fn (RRSet $rrset) => $rrset->toArray(),
                    $rrsets
                )])
            ->throw();
    }

    /**
     * @throws RequestException
     */
    public function updateZoneData(string $serverId, Zone $zone): void
    {
        $this
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
            ->throw();
    }

    /**
     * @throws RequestException
     */
    public function delete(string $serverId, string $zoneId): void
    {
        $this
            ->client
            ->delete(sprintf('servers/%s/zones/%s', $serverId, $zoneId))
            ->throw();
    }
}
