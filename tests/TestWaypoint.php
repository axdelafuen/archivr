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
     */
    public function testCanBeCreatedWaypointAndGetView(): void
    {
        $view = new View("test.path");

        $waypoint = new Waypoint($view);

        $this->assertSame($view->getPath(), $waypoint->getView()->getPath());
    }

}