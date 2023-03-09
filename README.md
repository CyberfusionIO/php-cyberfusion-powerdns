# PowerDNS

Documentation: https://doc.powerdns.com/authoritative/http-api/index.html

## Getting started

```php
use Cyberfusion\PowerDNS\Client;
use Cyberfusion\PowerDNS\PowerDNS;

$host = 'server:port';
$apiKey = 'secret';

$client = new Client($host, $apiKey);
$powerDns = new PowerDNS($client);

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

## Record all requests and responses

If you want to keep track of requests and responses, you can enable the client's recording functionality:

```php
$client->record();
```

And to get the requests/responses:

```php
[$request, $response] = $client->recorded()[0];
```

## Handling failed response

When a request fails, a `Illuminate\Http\Client\RequestException` will be thrown.