<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\Client;

abstract class Endpoint
{
    public function __construct(protected readonly Client $client)
    {
    }
}
