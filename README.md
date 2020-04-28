# Tesla API Client

PHP Client for interacting with Tesla API.

Easy read of car states and sending commands.


## Basic example

See tests folder for more examples.

```php
$client = new TeslaApiClient($youremail@domain.tld, $yourpassword);
$response = $client->getVehicles();
var_dump($response);
```

## Using composer
```
composer require avido/tesla-api-client
```

## Running tests
```
./vendor/bin/phpunit
```
## Documentation used for this client
https://tesla-api.timdorr.com/api-basics/vehicles
