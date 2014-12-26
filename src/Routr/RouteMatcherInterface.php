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
 * Interface RouteMatcherInterface
 *
 * @author <elliot@elliotwright.co>
 */
interface RouteMatcherInterface
{
    /**
     * Match a path against routes
     *
     * @param string $path
     * @param array  $routes
     *
     * @return mixed
     */
    public function match($path, $routes);
}
