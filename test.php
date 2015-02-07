<?php

require_once "vendor/autoload.php";

$router = new Router();

$router->route("user_collection", "/user")
    ->get("FooController::getCollectionAction")
;

$router->route("user", "/user/{id}")
    ->get("FooController::getAction")
    ->put("FooController::putAction")
;

$matched = $router->dispatch();

var_dump($matched);
