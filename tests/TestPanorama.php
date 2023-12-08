<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Panorama
 * @uses Map
 */
final class TestPanorama extends TestCase
{
    /**
     * @covers Panorama::__construct
     * @covers Panorama::getName
     * @covers Panorama::setName
     * @covers Panorama::getId
     */
    public function testCanBeCreatedPanoramaAndGetName(): void
    {
        $name = "testPanorama";

        $panorama = new Panorama($name);

        $this->assertSame($name, $panorama->getname());

        $this->assertIsString($panorama->getId());

        $newName = "newTestPanorama";

        $panorama->setName($newName);

        $this->assertSame($newName,$panorama->getName());
    }

    /**
     * @covers Panorama::setMap
     * @covers Panorama::getMap
     * @covers Panorama::isMap
     * @covers Panorama::removeMap
     */
    public function testSetAndGetMap():void
    {
        $map = new Map("map.path");

        $panorama = new Panorama("test");

        $panorama->setMap($map);

        $this->assertSame($map->getPath(),$panorama->getMap()->getPath());

        $this->assertTrue($panorama->isMap());

        $panorama->removeMap();

        $this->assertFalse($panorama->isMap());
    }

    /**
     * @covers Panorama::setViews
     * @covers Panorama::getViews
     * @covers Panorama::addView
     * @covers Panorama::getViewByPath
     * @covers Panorama::isView
     * @covers Panorama::removeView
     */
    public function testSetAndGetViews():void
    {
        $views = array();
        $views[] = new View("views.path");

        $view = new View("view.path");

        $panorama = new Panorama("test");

        $panorama->setViews($views);

        $this->assertSame($views[0]->getPath(), $panorama->getViews()[0]->getPath());

        $panorama->addView(1,$view);

        $this->assertSame($view->getPath(), $panorama->getViews()[1]->getPath());

        $viewById = $panorama->getViewByPath($view->getPath());

        $this->assertSame($viewById->getPath(), $view->getPath());

        $this->assertTrue($panorama->isView($view));

        $panorama->removeView($view);

        $this->assertFalse($panorama->isView($view));
    }

    /**
     * @covers Panorama::setTimelines
     * @covers Panorama::getTimelines
     * @covers Panorama::addTimeline
     * @covers Panorama::getTimelineById
     * @covers Panorama::removeTimeline
     */
    public function testSetAndGetTimelines():void
    {
        $timelines = array();
        $timelines[] = new Timeline("testTimelines");

        $timeline = new Timeline("testTimeline");

        $panorama = new Panorama("test");

        $panorama->setTimelines($timelines);

        $this->assertSame($timelines[0]->getName(), $panorama->getTimelines()[0]->getName());

        $panorama->addTimeline($timeline);

        $this->assertSame($timeline->getId(), $panorama->getTimelines()[1]->getId());

        $timelineById = $panorama->getTimelineById($timeline->getId());

        $this->assertSame($timelineById->getId(), $timeline->getId());

        $this->assertSame(2, count($panorama->getTimelines()));

        $panorama->removeTimeline($timeline);

        $this->assertSame(1,count($panorama->getTimelines()));
    }
}