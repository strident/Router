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
use Router\Route;
use Router\RouteMatcher;
use Router\RouteMatcherInterface;

/**
 * RouteMatcherTest
 *
 * @author Elliot Wright
 */
class RouteMatcherTest extends TestCase
{
    /**
     * @var RouteMatcher
     */
    protected $testMatcher;

    /**
     * @var Route[]
     */
    protected $testRoutes;


    public function setUp()
    {
        $route1 = new Route("foo", "/bar");
        $route1
            ->target("GET", "FooController::getCollectionAction")
            ->target("POST", "FooController::postAction")
        ;

        $route2 = new Route("baz", "/qux/{param}");
        $route2
            ->target("GET", "FooController::getAction")
            ->target("DELETE", "FooController::deleteAction")
        ;

        $this->testRoutes = [ $route1, $route2 ];
        $this->testMatcher = new RouteMatcher();
    }

    public function testMatchMatchesRoutes()
    {
        $matched = $this->testMatcher->match("GET", "/bar", $this->testRoutes);
        $expected = [
            "method"     => "GET",
            "name"       => "foo",
            "parameters" => [],
            "target"     => $this->testRoutes[0]->getTargetForMethod("GET")
        ];

        $this->assertEquals($expected, $matched);

        $matched = $this->testMatcher->match("POST", "/bar", $this->testRoutes);
        $expected = [
            "method"     => "POST",
            "name"       => "foo",
            "parameters" => [],
            "target"     => $this->testRoutes[0]->getTargetForMethod("POST")
        ];

        $this->assertEquals($expected, $matched);

        $matched = $this->testMatcher->match("GET", "/qux/1", $this->testRoutes);
        $expected = [
            "method"     => "GET",
            "name"       => "baz",
            "parameters" => [ "param" => "1", "1" ],
            "target"     => $this->testRoutes[1]->getTargetForMethod("GET")
        ];

        $this->assertEquals($expected, $matched);

        $matched = $this->testMatcher->match("DELETE", "/qux/1", $this->testRoutes);
        $expected = [
            "method"     => "DELETE",
            "name"       => "baz",
            "parameters" => [ "param" => "1", "1" ],
            "target"     => $this->testRoutes[1]->getTargetForMethod("DELETE")
        ];

        $this->assertEquals($expected, $matched);
    }

    public function testMatchDoesNotMatchInvalidMethod()
    {
        $matched = $this->testMatcher->match("PUT", "/bar", $this->testRoutes);

        $this->assertEquals(null, $matched);
    }

    public function testMatchDoesNotMatchInvalidRoute()
    {
        $matched = $this->testMatcher->match("GET", "/bar", []);

        $this->assertEquals(null, $matched);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testMatchThrowsIfRoutePathHasDuplicateParameters()
    {
        $route = new Route("foo", "/foo/{bar}/{bar}");

        $this->testMatcher->match("GET", "/foo/bar/baz", [ $route ]);
    }
}
