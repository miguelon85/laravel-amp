# Lavavel AMP (Accelerated Mobile Pages)

This package makes it easy to integrate [AMP](https://www.ampproject.org/) in your Laravel projects. By using the new ```Route::amp()``` notation.

## Installation

You can install the package via composer:

``` bash
composer require wearejust/laravel-amp
```

Register the service provider in your app.php

```php
// app.php
'providers' => [
    ...
    Just\Amp\Laravel\AmpServiceProvider::class,
],
'aliases' => [
    ...
    'AmpRouter' => Just\Amp\Laravel\AmpRouteFacade::class,
]
```

And register the custom ```Route::amp()``` notation in your ```RouteServiceProvider.php```.
```php
/// app/Providers/RouteServiceProvider.php
use AmpRouter;

...
public function boot(Router $router)
{
    AmpRouter::registerMacros();

    parent::boot($router);
}

```
## Usage

``` php
//route.php
Route::amp('url-of-my-route', ['as' => 'my-route', 'uses' => 'PageController@text']);
```

There well be two routes registered. One with '/url-of-my-route',  and one prefixed with the config value you specify in the config file such as `googleamp`. 
The logic for both routes is the same, but the view that's being rendered for the amp route affixed the the config value you specify in the config file (view-affix).
In your view, include the ```amp::tag``` file. This will match the AMP route (if exists) and put an link to the amp content in your HTML.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
