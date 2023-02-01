<?php

namespace Cyberfusion\PowerDNS\Models;

use Cyberfusion\PowerDNS\Contracts\Requestable;
use Cyberfusion\PowerDNS\Contracts\Responsable;
use Cyberfusion\PowerDNS\Enums\DaemonType;
use stdClass;

class Server implements Responsable, Requestable
{
    private string $id;

    private DaemonType $daemonType;

    private string $version;

    private string $url;

    private string $configUrl;

    private string $zonesUrl;

    private string $type = 'Server';

    public function __construct(
        string $id = '',
        DaemonType $daemonType = DaemonType::Authoritative,
        string $version = '',
        string $url = '',
        string $configUrl = '',
        string $zonesUrl = ''
    ) {
        $this
            ->setId($id)
            ->setDaemonType($daemonType)
            ->setVersion($version)
            ->setUrl($url)
            ->setConfigUrl($configUrl)
            ->setZonesUrl($zonesUrl);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Server
    {
        $this->id = $id;

        return $this;
    }

    public function getDaemonType(): DaemonType
    {
        return $this->daemonType;
    }

    public function setDaemonType(DaemonType $daemonType): Server
    {
        $this->daemonType = $daemonType;

        return $this;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): Server
    {
        $this->version = $version;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): Server
    {
        $this->url = $url;

        return $this;
    }

    public function getConfigUrl(): string
    {
        return $this->configUrl;
    }

    public function setConfigUrl(string $configUrl): Server
    {
        $this->configUrl = $configUrl;

        return $this;
    }

    public function getZonesUrl(): string
    {
        return $this->zonesUrl;
    }

    public function setZonesUrl(string $zonesUrl): Server
    {
        $this->zonesUrl = $zonesUrl;

        return $this;
    }

    public static function fromResponse(stdClass $data): self
    {
        return new self(
            id: $data->id,
            daemonType: DaemonType::from($data->daemon_type),
            version: $data->version,
            url: $data->url,
            configUrl: $data->config_url,
            zonesUrl: $data->zones_url
        );
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'id' => $this->id,
            'daemon_type' => $this
                ->daemonType
                ->value,
            'version' => $this->version,
            'url' => $this->url,
            'config_url' => $this->configUrl,
            'zones_url' => $this->zonesUrl,
        ];
    }
}
