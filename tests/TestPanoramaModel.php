<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Panorama
 * @uses Map
 * @uses View
 * @uses Timeline
 * @uses Waypoint
 */
final class TestPanoramaModel extends TestCase
{
    /**
     * @covers PanoramaModel::__construct
     * @covers PanoramaModel::addView
     * @covers PanoramaModel::getViewByPath
     * @covers PanoramaModel::removeView
     * @covers PanoramaModel::isView
     */
    public function testViewsMethods(): void
    {
        $panorama = new Panorama("testPanorama");

        $panoramaMdl = new PanoramaModel($panorama);

        $view = new View("test.path");

        $panoramaMdl->addView($view);

        $this->assertTrue($panoramaMdl->isView($view));

        $this->assertSame($view->getPath(), $panoramaMdl->getViewByPath($view->getPath())->getPath());

        $panoramaMdl->removeView($view);

        $this->assertFalse($panoramaMdl->isView($view));
    }

    /**
     * @covers PanoramaModel::addTimeline
     * @covers PanoramaModel::getTimelineById
     * @covers PanoramaModel::removeTimeline
     */
    public function testTimelinesMethods(): void
    {
        $panorama = new Panorama("testPanorama");

        $panoramaMdl = new PanoramaModel($panorama);

        $timeline = new Timeline("test");

        $panoramaMdl->addTimeline($timeline);

        $this->assertSame($timeline->getName(), $panoramaMdl->getTimelineById($timeline->getId())->getName());

        $panoramaMdl->removeTimeline($timeline);

        $this->assertNull($panoramaMdl->getTimelineById($timeline));
    }

    /**
     * @covers PanoramaModel::removeMap
     */
    public function testMapMethods(): void
    {
        $panorama = new Panorama("testPanorama");

        $panorama->setMap(new Map("test.path"));

        $panoramaMdl = new PanoramaModel($panorama);

        $this->assertSame("test.path", $panorama->getMap()->getPath());

        $panoramaMdl->removeMap();

        $this->assertNull($panorama->getMap());
    }

    /**
     * @covers PanoramaModel::removeMap
     */
    public function testWaypointsMethods(): void
    {
        $panorama = new Panorama("testPanorama");

        $view1 = new View("test");

        $view2 = new View("test2");

        $waypoint = new Waypoint($view1);

        $imageMdl = new ImageModel($view2);

        $imageMdl->addElement($waypoint);

        $panoramaMdl = new PanoramaModel($panorama);

        $panoramaMdl->addView($view1);
        $panoramaMdl->addView($view2);

        $this->assertSame($view2->getElements()[0]->getId(), $waypoint->getId());


        $panoramaMdl->removeEveryWaypointTo($view1);

        $this->assertNull($view2->getElements()[0]);
    }
}
