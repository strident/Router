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
 * Route
 *
 * @author <elliot@elliotwright.co>
 */
class Route
{
    /**
     * @var string
     */
    protected $regexp;


    /**
     * Constructor
     *
     * @param $regexp
     */
    public function __construct($regexp)
    {
        $this->regexp = $regexp;
    }

    /**
     * Get regexp
     *
     * @return string
     */
    public function getRegexp()
    {
        return $this->regexp;
    }

    /**
     * Set regexp
     *
     * @param string $regexp
     *
     * @return Route
     */
    public function setRegexp($regexp)
    {
        $this->regexp = $regexp;
        return $this;
    }
}
