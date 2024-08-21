# php-cyberfusion-powerdns

Easy-to-use PHP client for the PowerDNS API.

PowerDNS API documentation: https://doc.powerdns.com/authoritative/http-api/index.html

# Install

## Composer

Run the following command to install the package from Packagist:

    composer require cyberfusion/powerdns

# Usage

## Example

```php
use Cyberfusion\PowerDNS\PowerDNS;
use Cyberfusion\PowerDNS\Models\Zone;

$powerDns = new PowerDNS(host: 'server:port', apiKey: 'secret');

// Retrieve servers
$servers = $powerDns->servers()->list();

// Create a zone
$zone = $powerDns->zones()->create(
    serverId: $server[0]->getId(),
    zone: new Zone(name: 'cyberfusion.nl')
);

// Update a zone
$zone->setDnssec(true);
$success = $powerDns->zones()->updateZoneData($zone);
```

## Handling failed response

When a request fails, a `Illuminate\Http\Client\RequestException` is thrown.

