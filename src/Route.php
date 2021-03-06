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

use \RuntimeException;

/**
 * Route
 *
 * @author Elliot Wright
 */
class Route
{
    const CONNECT = "CONNECT";
    const DELETE  = "DELETE";
    const GET     = "GET";
    const HEAD    = "HEAD";
    const OPTIONS = "OPTIONS";
    const PATCH   = "PATCH";
    const POST    = "POST";
    const PUT     = "PUT";
    const TRACE   = "TRACE";

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var array
     */
    protected $targets;


    /**
     * Constructor
     *
     * @param string $name
     * @param string $path
     */
    public function __construct($name, $path)
    {
        $this->name = $name;
        $this->path = $path;
        $this->targets = [];
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Route
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Route
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get targets
     *
     * @return array
     */
    public function getTargets()
    {
        return $this->targets;
    }

    /**
     * Get target for method
     *
     * @param string $method
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public function getTargetForMethod($method)
    {
        if (!$this->hasTargetForMethod($method)) {
            throw new RuntimeException(sprintf(
                "Route named '%s' has no target defined for method '%s'.",
                $this->getName(),
                $method
            ));
        }

        return $this->targets[$method];
    }

    /**
     * Has targets for method
     *
     * @param string $method
     *
     * @return bool
     */
    public function hasTargetForMethod($method)
    {
        return isset($this->targets[$method]);
    }

    /**
     * Set targets
     *
     * @param array $targets
     *
     * @return Route
     */
    public function setTargets(array $targets)
    {
        $this->targets = $targets;

        return $this;
    }

    /**
     * Set a route target
     *
     * @param string $method
     * @param mixed  $target
     *
     * @return Route
     *
     * @throws \InvalidArgumentException
     */
    public function target($method, $target)
    {
        $method = strtoupper($method);

        if (!defined("self::$method")) {
            throw new \InvalidArgumentException(sprintf(
                'Invalid request method "%s" specified.',
                $method
            ));
        }

        $this->targets[$method] = $target;

        return $this;
    }
}
