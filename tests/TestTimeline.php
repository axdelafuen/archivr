<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Timeline
 * @uses View
 */
final class TestTimeline extends TestCase
{
    /**
     * @covers Timeline::__construct
     * @covers Timeline::getName
     * @covers Timeline::__toString
     */
    public function testCanBeCreatedTimelineAndGetName(): void
    {
        $name = "testName-aianpcac";

        $timeline = new Timeline($name);

        $this->assertSame($name, $timeline->getName());

        $this->assertSame($name, $timeline->__toString());
    }

    /**
     * @covers Timeline::getViews
     * @covers Timeline::setViews
     */
    public function testViewAttribute():void
    {
        $views = array();
        $views[] = new View("views.path");

        $timeline = new Timeline("test");

        $timeline->setViews($views);

        $this->assertSame($views[0]->getPath(), $timeline->getViews()[0]->getPath());

    }

    /**
     * @covers Timeline::jsonSerialize
     */
    public function testJsonSerialize():void
    {
        $timeline = new Timeline("test");

        $json = $timeline->jsonSerialize();

        $this->assertCount(3, $json);

        $this->assertArrayHasKey("id", $json);
        $this->assertArrayHasKey("name", $json);
        $this->assertArrayHasKey("views", $json);
    }
}