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
     * @var RouteCompilerInterface
     */
    protected $routeCompiler;

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
     * @param RouteCompilerInterface $routeCompiler
     * @param RouteMatcherInterface  $routeMatcher
     */
    public function __construct(RouteCompilerInterface $routeCompiler, RouteMatcherInterface $routeMatcher)
    {
        $this->routeCompiler = $routeCompiler;
        $this->routeMatcher  = $routeMatcher;

        $this->routes = [];
    }

    /**
     * Add a route
     *
     * @param string $name
     * @param string $path
     */
    public function route($name, $path)
    {
        $routes[$name] = $this->routeCompiler->compile($path);
    }

    /**
     * Dispatch the current request URL to the routes
     *
     * @param string $url
     *
     * @return array
     */
    public function dispatch($url)
    {
        $parsed = parse_url($url);
        $path   = $parsed['path'];

        return $this->routeMatcher->match($path, $this->routes);
    }
}
