<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Cyberfusion\PowerDNS\Enums\ZoneKind;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Zone implements Requestable, Responsable
{
    private string $id;

    private string $name;

    private string $type = 'Zone';

    private string $url;

    private ZoneKind $kind;

    private array $rrsets;

    private int $serial;

    private int $notifiedSerial;

    private int $editedSerial;

    private array $masters;

    private bool $dnssec;

    private string $nsec3param;

    private string $nsec3narrow;

    private bool $presigned;

    private string $soaEdit;

    private string $soaEditApi;

    private bool $apiRectify;

    private ?string $zone;

    private ?string $catalog;

    private ?string $account;

    private array $nameservers;

    private array $masterTsigKeyIds;

    private array $slaveTsigKeyIds;

    public function __construct(
        string $id = '',
        string $name = '',
        string $url = '',
        ZoneKind $kind = ZoneKind::Native,
        array $rrsets = [],
        int $serial = 0,
        int $notifiedSerial = 0,
        int $editedSerial = 0,
        array $masters = [],
        bool $dnssec = false,
        string $nsec3param = '',
        string $nsec3narrow = '',
        bool $presigned = false,
        string $soaEdit = 'INCEPTION-INCREMENT',
        string $soaEditApi = 'SOA-EDIT-INCREASE',
        bool $apiRectify = true,
        string $zone = null,
        string $catalog = null,
        string $account = null,
        array $nameservers = [],
        array $masterTsigKeyIds = [],
        array $slaveTsigKeyIds = []
    ) {
        $this
            ->setId($id)
            ->setName($name)
            ->setUrl($url)
            ->setKind($kind)
            ->setRrsets($rrsets)
            ->setSerial($serial)
            ->setNotifiedSerial($notifiedSerial)
            ->setEditedSerial($editedSerial)
            ->setMasters($masters)
            ->setDnssec($dnssec)
            ->setNsec3param($nsec3param)
            ->setNsec3narrow($nsec3narrow)
            ->setPresigned($presigned)
            ->setSoaEdit($soaEdit)
            ->setSoaEditApi($soaEditApi)
            ->setApiRectify($apiRectify)
            ->setZone($zone)
            ->setCatalog($catalog)
            ->setAccount($account)
            ->setNameservers($nameservers)
            ->setMasterTsigKeyIds($masterTsigKeyIds)
            ->setSlaveTsigKeyIds($slaveTsigKeyIds);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Zone
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        if (! Str::endsWith($this->name, '.')) {
            return $this->name.'.';
        }

        return $this->name;
    }

    public function setName(string $name): Zone
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Zone
    {
        $this->type = $type;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Zone
    {
        $this->url = $url;

        return $this;
    }

    public function getKind(): ZoneKind
    {
        return $this->kind;
    }

    public function setKind(ZoneKind $kind): Zone
    {
        $this->kind = $kind;

        return $this;
    }

    public function getRrsets(): array
    {
        return $this->rrsets;
    }

    public function setRrsets(array $rrsets): Zone
    {
        $this->rrsets = $rrsets;

        return $this;
    }

    public function getSerial(): int
    {
        return $this->serial;
    }

    public function setSerial(int $serial): Zone
    {
        $this->serial = $serial;

        return $this;
    }

    public function getNotifiedSerial(): int
    {
        return $this->notifiedSerial;
    }

    public function setNotifiedSerial(int $notifiedSerial): Zone
    {
        $this->notifiedSerial = $notifiedSerial;

        return $this;
    }

    public function getEditedSerial(): int
    {
        return $this->editedSerial;
    }

    public function setEditedSerial(int $editedSerial): Zone
    {
        $this->editedSerial = $editedSerial;

        return $this;
    }

    public function getMasters(): array
    {
        return $this->masters;
    }

    public function setMasters(array $masters): Zone
    {
        $this->masters = $masters;

        return $this;
    }

    public function isDnssec(): bool
    {
        return $this->dnssec;
    }

    public function setDnssec(bool $dnssec): Zone
    {
        $this->dnssec = $dnssec;

        return $this;
    }

    public function getNsec3param(): string
    {
        return $this->nsec3param;
    }

    public function setNsec3param(string $nsec3param): Zone
    {
        $this->nsec3param = $nsec3param;

        return $this;
    }

    public function getNsec3narrow(): string
    {
        return $this->nsec3narrow;
    }

    public function setNsec3narrow(string $nsec3narrow): Zone
    {
        $this->nsec3narrow = $nsec3narrow;

        return $this;
    }

    public function isPresigned(): bool
    {
        return $this->presigned;
    }

    public function setPresigned(bool $presigned): Zone
    {
        $this->presigned = $presigned;

        return $this;
    }

    public function getSoaEdit(): string
    {
        return $this->soaEdit;
    }

    public function setSoaEdit(string $soaEdit): Zone
    {
        $this->soaEdit = $soaEdit;

        return $this;
    }

    public function getSoaEditApi(): string
    {
        return $this->soaEditApi;
    }

    public function setSoaEditApi(string $soaEditApi): Zone
    {
        $this->soaEditApi = $soaEditApi;

        return $this;
    }

    public function isApiRectify(): bool
    {
        return $this->apiRectify;
    }

    public function setApiRectify(bool $apiRectify): Zone
    {
        $this->apiRectify = $apiRectify;

        return $this;
    }

    public function getZone(): ?string
    {
        return $this->zone;
    }

    public function setZone(?string $zone): Zone
    {
        $this->zone = $zone;

        return $this;
    }

    public function getCatalog(): ?string
    {
        return $this->catalog;
    }

    public function setCatalog(?string $catalog): Zone
    {
        $this->catalog = $catalog;

        return $this;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setAccount(?string $account): Zone
    {
        $this->account = $account;

        return $this;
    }

    public function getNameservers(): array
    {
        return $this->nameservers;
    }

    public function setNameservers(array $nameservers): self
    {
        $this->nameservers = array_map(
            function (string $nameserver): string {
                if (! Str::endsWith('.', $nameserver)) {
                    $nameserver .= '.';
                }

                return $nameserver;
            },
            $nameservers
        );

        return $this;
    }

    public function getMasterTsigKeyIds(): array
    {
        return $this->masterTsigKeyIds;
    }

    public function setMasterTsigKeyIds(array $masterTsigKeyIds): Zone
    {
        $this->masterTsigKeyIds = $masterTsigKeyIds;

        return $this;
    }

    public function getSlaveTsigKeyIds(): array
    {
        return $this->slaveTsigKeyIds;
    }

    public function setSlaveTsigKeyIds(array $slaveTsigKeyIds): Zone
    {
        $this->slaveTsigKeyIds = $slaveTsigKeyIds;

        return $this;
    }

    public static function fromResponse(array $data): self
    {
        return new self(
            id: Arr::get($data, 'id', ''),
            name: Arr::get($data, 'name', ''),
            url: Arr::get($data, 'url', ''),
            kind: ZoneKind::tryFrom(Arr::get($data, 'kind')),
            rrsets: array_map(
                fn (array $rrset) => RRSet::fromResponse($rrset),
                Arr::get($data, 'rrsets', [])
            ),
            serial: Arr::get($data, 'serial', ''),
            notifiedSerial: Arr::get($data, 'notified_serial', ''),
            editedSerial: Arr::get($data, 'edited_serial', ''),
            masters: Arr::get($data, 'masters', []),
            dnssec: Arr::get($data, 'dnssec', false),
            nsec3param: Arr::get($data, 'nsec3param', ''),
            nsec3narrow: Arr::get($data, 'nsec3narrow', ''),
            presigned: Arr::get($data, 'presigned', false),
            soaEdit: Arr::get($data, 'soa_edit', ''),
            soaEditApi: Arr::get($data, 'soa_edit_api', ''),
            apiRectify: Arr::get($data, 'api_rectify', true),
            zone: Arr::get($data, 'zone', ''),
            catalog: Arr::get($data, 'catalog', ''),
            account: Arr::get($data, 'account', ''),
            nameservers: Arr::get($data, 'nameservers', []),
            masterTsigKeyIds: Arr::get($data, 'master_tsig_key_ids', []),
            slaveTsigKeyIds: Arr::get($data, 'slave_tsig_key_ids', []),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getName(),
            'type' => $this->type,
            'url' => $this->url,
            'kind' => $this
                ->kind
                ->value,
            'rrsets' => array_map(
                fn (RRSet $rrset) => $rrset->toArray(),
                $this->rrsets
            ),
            'serial' => $this->serial,
            'notified_serial' => $this->notifiedSerial,
            'edited_serial' => $this->editedSerial,
            'masters' => $this->masters,
            'dnssec' => $this->dnssec,
            'nsec3param' => $this->nsec3param,
            'nsec3narrow' => $this->nsec3narrow,
            'presigned' => $this->presigned,
            'soa_edit' => $this->soaEdit,
            'soa_edit_api' => $this->soaEditApi,
            'api_rectify' => $this->apiRectify,
            'zone' => $this->zone,
            'catalog' => $this->catalog,
            'account' => $this->account,
            'nameservers' => $this->nameservers,
            'master_tsig_key_ids' => $this->masterTsigKeyIds,
            'slave_tsig_key_ids' => $this->slaveTsigKeyIds,
        ];
    }
}
