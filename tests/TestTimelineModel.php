<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses View
 * @uses Timeline
 */
final class TestTimelineModel extends TestCase
{
    /**
     * @covers TimelineModel::__construct
     * @covers TimelineModel::addView
     * @covers TimelineModel::isView
     * @covers TimelineModel::getViewByPath
     * @covers TimelineModel::getFirstView
     * @covers TimelineModel::removeView
     */
    public function testViewsMethods(): void
    {
        $timeline = new Timeline("test");
        $timelineMdl = new TimelineModel($timeline);

        $view1 = new View("test.path");
        $view2 = new View("test.path2");

        $timelineMdl->addView($view1);

        $this->assertTrue($timelineMdl->isView($view1));

        $this->assertSame($view1->getPath(), $timelineMdl->getViewByPath($view1->getPath())->getPath());

        $timelineMdl->addView($view2);

        $this->assertSame($view1->getPath(), $timelineMdl->getFirstView()->getPath());

        $timelineMdl->removeView($view1);

        $this->assertFalse($timelineMdl->isView($view1));

        $this->assertSame($view2->getPath(), $timelineMdl->getFirstView()->getPath());

    }

}
