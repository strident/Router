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

namespace Strident\Router\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use Strident\Router\RouteFactory;
use Strident\Router\RouteMatcher;
use Strident\Router\Router;

/**
 * RouterTest
 *
 * @author Elliot Wright
 */
class RouterTest extends TestCase
{
    /**
     * @var string
     */
    protected $testMethod;

    /**
     * @var string
     */
    protected $testName;

    /**
     * @var string
     */
    protected $testPath;

    /**
     * @var Router
     */
    protected $testRouter;

    /**
     * @var string
     */
    protected $testTarget;


    public function setUp()
    {
        $this->testMethod = "GET";
        $this->testName = "foo";
        $this->testPath = "/bar";
        $this->testTarget = "FooController::barAction";

        $routeFactory = new RouteFactory();
        $routeMatcher = new RouteMatcher();

        $this->testRouter = new Router($routeFactory, $routeMatcher);
    }

    public function testRoute()
    {
        $route = $this->testRouter->route($this->testName, $this->testPath);

        $this->assertInstanceOf("Strident\\Router\\Route", $route);
        $this->assertEquals($this->testName, $route->getName());
        $this->assertEquals($this->testPath, $route->getPath());
    }

    public function testDispatch()
    {
        $expectedMatch = [
            "method"     => $this->testMethod,
            "name"       => $this->testName,
            "parameters" => [],
            "target"     => $this->testTarget
        ];

        $route = $this->testRouter->route($this->testName, $this->testPath);
        $route->target($this->testMethod, $this->testTarget);

        $matched = $this->testRouter->dispatch("GET", $this->testPath);

        $this->assertInternalType("array", $matched);
        $this->assertEquals($expectedMatch, $matched);
    }
}
