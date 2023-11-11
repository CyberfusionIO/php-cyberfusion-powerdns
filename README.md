# laravel-powerdns

PHP client for PowerDNS API.

Documentation: https://doc.powerdns.com/authoritative/http-api/index.html

# Usage

## Example

```php
use Cyberfusion\PowerDNS\PowerDNS;
use Cyberfusion\PowerDNS\Models\Zone;

$host = 'server:port';
$apiKey = 'secret';

$powerDns = new PowerDNS($host, $apiKey);

$servers = $powerDns
    ->servers()
    ->list;

$zone = $powerDns
    ->zones()
    ->create($server[0]->getId(), (new Zone(name: 'cyberfusion.nl'));

$zone->setDnssec(true);

$success = $powerDns
    ->zones()
    ->update($zone);
```

## Handling failed response

When a request fails, `Illuminate\Http\Client\RequestException` is thrown.
