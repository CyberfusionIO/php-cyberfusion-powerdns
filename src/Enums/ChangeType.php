<?php

namespace Cyberfusion\PowerDNS\Enums;

enum ChangeType: string
{
    case Delete = 'DELETE';
    case Replace = 'REPLACE';
}
