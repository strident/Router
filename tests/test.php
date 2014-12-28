<?php

require('../vendor/autoload.php');

$start = microtime(true);

use Routr\RouteMatcher;
use Routr\Router;

$matcher = new RouteMatcher();
$router = new Router($matcher);
$router->route('blog_article', '/blog/articles/{id}/{slug}')
    ->target('GET', [ 'blog.controller.article:getAction' ])
    ->target('POST', [
        'security.middleware.authentication:authenticate',
        'blog.controller.article:postAction',
    ])
;

$matched = $router->dispatch('GET', 'http://example.com:8080/blog/articles/12/this-is-the-slug');

//var_dump($matched);

echo "\n";
echo 'Routr: ' . ((microtime(true) - $start) * 1000) . 'ms';
echo "\n";
//echo "\n";
//
//$start = microtime(true);
//
//use Symfony\Component\Routing\Matcher\UrlMatcher;
//use Symfony\Component\Routing\RequestContext;
//use Symfony\Component\Routing\RouteCollection;
//use Symfony\Component\Routing\Route;
//
//$route = new Route('/blog/articles/{id}/{slug}', array('controller' => 'MyController'));
//$routes = new RouteCollection();
//$routes->add('route_name', $route);
//
//$context = new RequestContext('http://example.com:8080/blog/articles/12/this-is-the-slug');
//$matcher = new UrlMatcher($routes, $context);
//
//$parameters = $matcher->match('/blog/articles/12/this-is-the-slug');
//
////var_dump($parameters);
//
//echo "\n";
//echo 'Symfony: ' . ((microtime(true) - $start) * 1000) . 'ms';

