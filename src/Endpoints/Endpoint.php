<?php

namespace Cyberfusion\PowerDNS\Endpoints;

use Cyberfusion\PowerDNS\PowerDNS;

abstract class Endpoint
{
    public function __construct(protected readonly PowerDNS $powerDNS)
    {
    }
}
