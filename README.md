#Router 
[![Build Status](https://img.shields.io/travis/Strident/Router.svg)](https://travis-ci.org/Strident/Router) 
[![Coverage](https://img.shields.io/codeclimate/coverage/github/Strident/Router.svg)](https://codeclimate.com/github/Strident/Router)
[![Code Climate](https://img.shields.io/codeclimate/github/Strident/Router.svg)](https://codeclimate.com/github/Strident/Router)

Routing component designed for ease of use and speed. Built for Trident.

##Installation

Installation is available via Composer. Add the package to your `composer.json`:

```
$ composer require strident/router ~1.0
```

##Usage

The Strident Router package is flexible and allows you to swap out components to extend it easier. To create a `Router`, do the following:

```php
use Strident\Router\RouteFactory;
use Strident\Router\RouteMatcher;
use Strident\Router\Router;

$factory = new RouteFactory();
$matcher = new RouteMatcher();
$router  = new Router($factory, $matcher);
```

From there, you can define routes like so:

```php
$router->route("route_name", "/route/path/{parameter}/{placeholders}")
    ->target("GET", "FooController::getAction")
    ->target("POST", "FooController::postAction")
;
```

The `route()` method of the `Router` returns the instance of a the created `Route`. The `Route` can then define it's targets for specific HTTP methods by using the `target()` method.

To dispatch the current request in the `Router`, use the `dispatch()` method of the `Router`.

```php
$matched = $router->dispatch("GET", "/route/path/1/2");
```

The return value of `dispatch()` is an array containing information about the matched route. This includes the name of the route, the request method, the path, and the parameters (by name, and index).
