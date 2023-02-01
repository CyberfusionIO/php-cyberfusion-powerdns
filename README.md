# PowerDNS

Documentation: https://doc.powerdns.com/authoritative/http-api/index.html

## Getting started

```php
use Cyberfusion\PowerDNS\Client;
use Cyberfusion\PowerDNS\PowerDNS;

$host = 'server:port';
$apiKey = 'secret';

$powerDns = new PowerDNS(new Client($host, $apiKey));

$servers = $powerDns
    ->servers()
    ->list;

$zone = $powerDns
    ->zones()
    ->create($server[0]->getId(), 'cyberfusion.nl');

$zone->setDnssec(true);

$success = $powerDns
    ->zones()
    ->update($zone);
```

## Endpoints

CryptoKeys, Servers and Zones are available.
