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

/**
 * RouteTest
 *
 * @author Elliot Wright
 */
class RouteTest extends TestCase
{
    /**
     * @var string
     */
    protected $testName;

    /**
     * @var string
     */
    protected $testPath;

    /**
     * @var Route
     */
    protected $testRoute;

    /**
     * @var string
     */
    protected $testTarget;


    public function setUp()
    {
        $this->testName = "test_route";
        $this->testPath = "/foo/{bar}";
        $this->testTarget = "FooController::barAction";

        $this->testRoute = new Route($this->testName, $this->testPath);
    }

    public function testGetName()
    {
        $this->assertEquals($this->testName, $this->testRoute->getName());
    }

    public function testSetName()
    {
        $newName = "test_route2";

        $this->testRoute->setName($newName);
        $this->assertEquals($newName, $this->testRoute->getName());
    }

    public function testGetPath()
    {
        $this->assertEquals($this->testPath, $this->testRoute->getPath());
    }

    public function testSetPath()
    {
        $newPath = "/baz/{qux}";

        $this->testRoute->setPath($newPath);
        $this->assertEquals($newPath, $this->testRoute->getPath());
    }

    public function testGetTargets()
    {
        $targets = $this->testRoute->getTargets();

        $this->assertInternalType("array", $targets);
        $this->assertEquals([], $targets);
    }

    public function testGetTargetsForMethod()
    {
        $this->testRoute->target("GET", $this->testTarget);

        $this->assertEquals(
            $this->testTarget,
            $this->testRoute->getTargetForMethod("GET")
        );
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testGetTargetsForMethodThrowsIfNoTarget()
    {
        $this->testRoute->getTargetForMethod("GET");
    }

    public function testHasTargetsForMethod()
    {
        $this->assertFalse($this->testRoute->hasTargetForMethod("GET"));

        $this->testRoute->target("GET", $this->testTarget);

        $this->assertTrue($this->testRoute->hasTargetForMethod("GET"));
    }

    public function testSetTargets()
    {
        $newTargets = [
            "GET" => $this->testTarget
        ];

        $this->assertEquals([], $this->testRoute->getTargets());

        $this->testRoute->setTargets($newTargets);

        $this->assertEquals($newTargets, $this->testRoute->getTargets());
    }

    public function testTarget()
    {
        $this->testRoute->target("GET", $this->testTarget);

        $targets = $this->testRoute->getTargets();

        $this->assertEquals($targets, [
            "GET" => $this->testTarget
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTargetThrowsIfProvidedInvalidMethod()
    {
        $this->testRoute->target("FOOBAR", $this->testTarget);
    }
}
