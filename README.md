# WuBook library for Lravel 8

This version of Laravel Wubook was modified by Andrii Strilchuk, is based in the
[ilgala/laravel-wubook](https://github.com/ilgala/laravel-wubook). 

## Installation

```bash
$ composer require and48/laravel-wubook
```

## Configuration

Laravel WuBook requires connection configuration.

Publish the package migrations files to your application.

```bash
php artisan vendor:publish --provider="AND48\LaravelWubook\WuBookServiceProvider" --tag="migrations"
```
This will create a `wubook_configs` table in your DB that you can modify to set your configuration (lcode and token).

## Usage

##### WuBookManager

This is the class of most interest. It is bound to the ioc container as `'wubook'` and can be accessed using the `Facades\WuBook` facade. In order to make a call to the Wired API, you may call these methods that refers to a specific area of the service. 

* `availability()`
* `channel_manager()`
* `prices()`
* `reservations()`
* `restrictions()`
* `rooms()`

##### Facades\WuBook

This facade will dynamically pass static method calls to the `'wubook'` object in the ioc container which by default is the `WuBookManager` class.


##### WuBook API methods results

The [fxmlrpc client](https://github.com/lstrojny/fxmlrpc) always returns an associative array, that may be changed by the package in order to retrieve the resulting data from the XML/RPC function.

If an error occured during the call, a `WuBookException` will be thrown. If the call is successfully executed an array will be returned with this values:

```php
// An error occurred
return [
    'has_error' => true,
    'code' => -100,
    'data' => 'A human readeable error message'
];

// Success
return [
    'has_error' => false,
    'code' => 0,
    'data' => [ /* THE XML/RPC FUNCTION RESPONSE */ ]
];
```

##### Real Examples

Here you can see an example of just how simple this package is to use:

```php
use AND48\LaravelWubook\Facades\WuBook;
use AND48\LaravelWubook\Models\WubookConfig;

$credentials = WubookConfig::find(1)->only(['lcode', 'token']);
WuBook::rooms($credentials)->fetch_rooms();
// this example is simple, and there are far more methods available
// The result will be an associative array with this structure

[
    0 => [
        id => 123,
        name => 'room',
        shortname => 'ro',
        occupancy => 2,
        men => 2,
        children => 0,
        subroom => 0,
        // ...
    ],
    1 => [
        // ...
    ],
];
```

For more information on how to use the `\LaravelWubook\WuBookManager` class we are calling behind the scenes here, check out the [Wired API doc](https://tdocs.wubook.net/wired.html).


## Security

If you discover a security vulnerability within this package, please send an e-mail to Andrii Strilchuk at cater_pill@yahoo.com. All security vulnerabilities will be promptly addressed.

## License

Laravel WuBook is licensed under [The MIT License (MIT)](LICENSE).

## Tests

```bash
$ composer test
$ composer test-f RoomTest
```

It is recommended to run with empty account on the wubook.
