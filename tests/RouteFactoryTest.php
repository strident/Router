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

namespace Router\Tests;

use PHPUnit_Framework_TestCase as TestCase;
use Router\RouteFactory;

/**
 * RouteFactoryTest
 *
 * @author Elliot Wright
 */
class RouteFactoryTest extends TestCase
{
    /**
     * @var RouteFactory
     */
    protected $testFactory;


    public function setUp()
    {
        $this->testFactory = new RouteFactory();
    }

    public function testBuildBuildsRoute()
    {
        $route = $this->testFactory->build("foo", "/bar");

        $this->assertInstanceOf("Router\\Route", $route);
    }

    public function testBuildProvidesParametersToRoute()
    {
        $testName = "foo";
        $testPath = "/bar";

        $route = $this->testFactory->build($testName, $testPath);

        $this->assertEquals($testName, $route->getName());
        $this->assertEquals($testPath, $route->getPath());
    }
}
