<?php

namespace Cyberfusion\PowerDNS\Contracts;

use stdClass;

interface Responsable
{
    public static function fromResponse(stdClass $data);
}
