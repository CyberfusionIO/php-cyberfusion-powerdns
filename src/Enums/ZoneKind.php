<?php

namespace Cyberfusion\PowerDNS\Enums;

enum ZoneKind: string
{
    case Native = 'Native';
    case Master = 'Master';
    case Slave = 'Slave';
    case Producer = 'Producer';
    case Consumer = 'Consumer';
}
