# PowerDNS

This package provides an easy-to-use PHP client for the PowerDNS API.

The documentation of the PowerDNS itself can be found at https://doc.powerdns.com/authoritative/http-api/index.html

# Usage

## Requirements

This package requires Laravel 10+ and PHP 8.3 or higher.

## Installation

You can install the package via composer:

```bash
composer require cyberfusion/powerdns
```

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

## Tests

Unit tests are available in the `tests` directory. Run:

`composer test`

To generate a code coverage report in the `build/report` directory, run:

`composer test:coverage`

## Contributing

Contributions are welcome. See the [contributing guidelines](CONTRIBUTING.md).

## Security

If you discover any security related issues, please email support@cyberfusion.io instead of using the issue tracker.

## License

This client is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).