<?php

namespace Cyberfusion\PowerDNS\Enums;

enum DaemonType: string
{
    case Recursor = 'recursor';
    case Authoritative = 'authoritative';
}
