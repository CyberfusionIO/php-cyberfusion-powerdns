<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Client;
use Illuminate\Http\Client\Response;

abstract class Endpoint
{
    protected ?Response $latestResponse = null;

    public function __construct(protected readonly Client $client)
    {
    }

    public function getLatestResponse(): ?Response
    {
        return $this->latestResponse;
    }
}
