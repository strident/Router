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

namespace Strident\Router;

/**
 * Interface RouteMatcherInterface
 *
 * @author Elliot Wright
 */
interface RouteMatcherInterface
{
    /**
     * Match the route context against routes
     *
     * @param string $method
     * @param string $url
     * @param array  $routes
     *
     * @return mixed
     */
    public function match($method, $url, $routes);
}
