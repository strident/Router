<?php

/**
 * This file is part of the Router package.
 *
 * @package Router
 * @since   2015
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once "vendor/autoload.php";

use Router\RouteFactory;
use Router\RouteMatcher;
use Router\Router;

$factory = new RouteFactory();
$matcher = new RouteMatcher();
$router = new Router($factory, $matcher);

$router->route("foo", "/bar/{baz}")
    ->target("GET", "service.controller.name::getAction")
    ->target("DELETE", "service.controller.name::deleteAction")
;

$router->route("foo_collection", "/bar")
    ->target("GET", "FooController::getCollectionAction")
    ->target("POST", "FooController::postAction")
;

$matched = $router->dispatch("GET", "/bar/2");

var_dump($matched);
