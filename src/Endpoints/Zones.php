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
            ->powerDNS
            ->httpClient()
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
    public function create(string $serverId, Zone $zone): ?Zone
    {
        $data = $zone->toArray();
        if ($data['dnssec'] === false) {
            unset($data['nsec3param'], $data['nsec3narrow']);
        }

        $response = $this
            ->powerDNS
            ->httpClient()
            ->post(sprintf('servers/%s/zones', $serverId), $data)
            ->throw();

        return Zone::fromResponse($response->json());
    }

    /**
     * @throws RequestException
     */
    public function get(string $serverId, string $zoneId): ?Zone
    {
        $response = $this
            ->powerDNS
            ->httpClient()
            ->get(sprintf('servers/%s/zones/%s?rrsets=true', $serverId, $zoneId))
            ->throw();

        return Zone::fromResponse($response->json());
    }

    /**
     * @param array<RRSet> $rrsets
     *
     * @throws RequestException
     */
    public function updateRrsets(string $serverId, string $zoneId, array $rrsets): void
    {
        $this
            ->powerDNS
            ->httpClient()
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
            ->powerDNS
            ->httpClient()
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
            ->powerDNS
            ->httpClient()
            ->delete(sprintf('servers/%s/zones/%s', $serverId, $zoneId))
            ->throw();
    }
}
