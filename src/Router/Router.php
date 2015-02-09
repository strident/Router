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

namespace Router;

/**
 * Router
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class Router
{
    /**
     * @var RouteFactory
     */
    protected $routeFactory;

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
     * @param RouteFactory           $routeFactory
     * @param RouteMatcherInterface  $routeMatcher
     */
    public function __construct(RouteFactory $routeFactory, RouteMatcherInterface $routeMatcher)
    {
        $this->routeFactory = $routeFactory;
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
        $route = $this->routeFactory->build($name, $path);

        return $this->routes[$name] = $route;
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
