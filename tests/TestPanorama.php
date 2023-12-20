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
     */
    public function testSetAndGetMap():void
    {
        $map = new Map("map.path");

        $panorama = new Panorama("test");

        $panorama->setMap($map);

        $this->assertSame($map->getPath(),$panorama->getMap()->getPath());

        $panorama->setMap(null);

        $this->assertNull($panorama->getMap());
    }

    /**
     * @covers Panorama::setViews
     * @covers Panorama::getViews
     */
    public function testSetAndGetViews():void
    {
        $views = array();
        $views[] = new View("views.path");

        $view = new View("view.path");

        $panorama = new Panorama("test");

        $panorama->setViews($views);

        $this->assertSame($views[0]->getPath(), $panorama->getViews()[0]->getPath());

    }

    /**
     * @covers Panorama::setTimelines
     * @covers Panorama::getTimelines
     */
    public function testSetAndGetTimelines():void
    {
        $timelines = array();
        $timelines[] = new Timeline("testTimelines");

        $timeline = new Timeline("testTimeline");

        $panorama = new Panorama("test");

        $panorama->setTimelines($timelines);

        $this->assertSame($timelines[0]->getName(), $panorama->getTimelines()[0]->getName());
    }

    /**
     * @covers Panorama::jsonSerialize
     */
    public function testJsonSerialize():void
    {
        $panorama = new Panorama("test");
        $json = $panorama->jsonSerialize();

        $this->assertCount(5, $json);

        $this->assertArrayHasKey("id", $json);
        $this->assertArrayHasKey("name", $json);
        $this->assertArrayHasKey("timelines", $json);
        $this->assertArrayHasKey("views", $json);
        $this->assertArrayHasKey("map", $json);
    }
}