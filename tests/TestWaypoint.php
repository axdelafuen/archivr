<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Waypoint
 * @uses Position
 * @uses Rotation
 * @covers Element
 */
final class TestWaypoint extends TestCase
{
    /**
     * @covers Waypoint::__construct
     * @covers Waypoint::getView
     * @covers Waypoint::getViewName
     */
    public function testCanBeCreatedWaypointAndGetView(): void
    {
        $viewPath = "test.path";

        $view = new View($viewPath);

        $waypoint = new Waypoint($view);

        $this->assertSame($view->getPath(), $waypoint->getView()->getPath());

        $viewName = "test";

        $this->assertSame($waypoint->getViewName(), $viewName);
    }

    /**
     * @covers Waypoint::setScale
     * @covers Waypoint::getScale
     * @covers Waypoint::getScaleInt
     */
    public function testScaleAttributes():void
    {
        $view = new View("test.path");

        $waypoint = new Waypoint($view);

        $scale = 1.2;

        // test default value
        $this->assertSame($waypoint->getScale(), "1 1 1");

        $waypoint->setScale($scale);

        $this->assertSame($waypoint->getScaleInt(), $scale);

        $this->assertSame($waypoint->getScale(), (string)$scale." ".(string)$scale." ".(string)$scale);
    }
}