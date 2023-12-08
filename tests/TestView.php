<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses View
 * @uses Rotation
 * @covers Image
 */
final class TestView extends TestCase
{
    /**
     * @covers View::__construct
     * @covers View::getPath
     */
    public function testCanBeCreatedViewAndGetPath(): void
    {
        $path = "&àcàç&cn&ciosc.jpg";

        $view = new View($path);

        $this->assertSame($path, $view->getPath());
    }
    /**
     * @covers View::getName
     */
    public function testGetName(): void
    {
        $path = "&àcàç&cn&ciosc.jpg";

        $view = new View($path);

        $name = substr($path, 0, strpos($path, "."));

        $this->assertSame($name, $view->getName());
    }
    /**
     * @covers View::isDate
     */
    public function testIsDate():void
    {
        $view = new View('test.jpg');

        $this->assertFalse($view->isDate());
    }

    /**
     * @covers View::getDate
     * @covers View::setDate
     */
    public function testSetAndGetDate():void
    {
        $view = new View('test.jpg');

        $date = 1975;

        $view->setDate($date);

        $this->assertSame($view->getDate(), $date);
    }

    /**
     * @uses Rotation
     * @covers View::setCameraRotation
     * @covers View::getCameraRotation
     */
    public function testSetAndGetCameraRotation():void
    {
        $view = new View('test.jpg');

        $rotation = new Rotation();

        $view->setCameraRotation($rotation->getX(), $rotation->getY(), $rotation->getX());

        $this->assertSame($view->getCameraRotation()->getRotation(), $rotation->getRotation());
    }
    /**
     * @covers View::set
     * @covers View::getElements
     */
    public function testSetData():void
    {
        $data = array();
        $data[] = new Sign("test");

        $view = new View("path.path");

        $view->set($data);

        $this->assertSame($data[0], $view->getElements()[0]);
    }
}