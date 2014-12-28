<?php

/**
 * This file is part of the Routr package.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Codeception\TestCase\Test;
use Routr\Route;

/**
 * RouteTest
 *
 * @author <elliot@elliotwright.co>
 */
class RouteTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;


    /**
     * {@inheritDoc}
     */
    protected function _before()
    {
    }

    /**
     * {@inheritDoc}
     */
    protected function _after()
    {
    }

    public function testGetName()
    {
        $route = new Route("test", "/test");

        $this->assertEquals("test", $route->getName());
    }

    public function testSetName()
    {
        $route = new Route("test", "/test");

        $this->assertEquals("test", $route->getName());

        $route->setName("changed_test");

        $this->assertEquals("changed_test", $route->getName());
    }
}
