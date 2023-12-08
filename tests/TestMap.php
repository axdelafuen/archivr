<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Map
 * @covers Image
 * @covers Map::__construct
 * @covers Map::getPath
 */
final class TestMap extends TestCase
{
    public function testCanBeCreatedViewAndGetPath(): void
    {
        $path = "&àcàç&cn&ciosc.jpg";

        $map = new Map($path);

        $this->assertSame($path, $map->getPath());
    }

    /**
     * @covers Map::set
     * @covers Map::getElements
     */
    public function testSetData():void
    {
        $data = array();
        $data[] = new Sign("test");

        $map = new Map("path.path");

        $map->set($data);

        $this->assertSame($data[0], $map->getElements()[0]);
    }

    /**
     * @covers Map::addElement
     * @covers Map::getElements
     * @covers Map::removeElement
     */
    public function testAddAndRemoveElement():void
    {
        $element = new Sign("test");

        $map = new Map("path.path");

        $map->addElement($element);

        $this->assertSame($element, $map->getElements()[0]);

        $map->removeElement($element);

        $this->assertSame(0,count($map->getElements()));
    }

    /**
     * @covers Map::getElementById
     */
    public function testGetElementById():void
    {
        $element = new Sign("test");

        $map = new Map("path.path");

        $map->addElement($element);

        $elementById = $map->getElementById($element->getId());

        $this->assertSame($elementById->getId(), $element->getId());
    }
}