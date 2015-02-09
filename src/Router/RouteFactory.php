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
 * Route Factory
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class RouteFactory
{
    /**
     * Build a Route
     *
     * @param string $name
     * @param string $path
     *
     * @return Route
     */
    public function build($name, $path)
    {
        return new Route($name, $path);
    }
}
