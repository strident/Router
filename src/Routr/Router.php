<?php

/**
 * This file is part of the Routr package.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Routr;

/**
 * Router
 *
 * @author <elliot@elliotwright.co>
 */
class Router
{
    /**
     * @var RouteMatcherInterface
     */
    protected $routeMatcher;

    /**
     * @var array
     */
    protected $routes;


    /**
     * Constructor
     *
     * @param RouteMatcherInterface  $routeMatcher
     */
    public function __construct(RouteMatcherInterface $routeMatcher)
    {
        $this->routeMatcher = $routeMatcher;
        $this->routes = [];
    }

    /**
     * Add a route
     *
     * @param string $name
     * @param string $path
     *
     * @return Route
     */
    public function route($name, $path)
    {
        return $this->routes[$name] = new Route($name, $path);
    }

    /**
     * Dispatch the current request URL to the routes and retrieve target
     *
     * @param string $method
     * @param string $url
     *
     * @return mixed
     */
    public function dispatch($method, $url)
    {
        return $this->routeMatcher->match($method, $url, $this->routes);
    }
}
