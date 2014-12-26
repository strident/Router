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
 * Interface RouteCompilerInterface
 *
 * @author <elliot@elliotwright.co>
 */
interface RouteCompilerInterface
{
    /**
     * Compile a route to valid regexp
     *
     * @param string $path
     *
     * @return string
     */
    public function compile($path);
}
