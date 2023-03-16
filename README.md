# laravel-powerdns

PHP client for PowerDNS API.

Documentation: https://doc.powerdns.com/authoritative/http-api/index.html

# Usage

## Example

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

## Record all requests and responses

To keep track of requests and responses, enable the recording functionality:

```php
$client->record();
```

... and to get the requests/responses:

```php
[$request, $response] = $client->recorded()[0];
```

## Handling failed response

When a request fails, `Illuminate\Http\Client\RequestException` is thrown.
