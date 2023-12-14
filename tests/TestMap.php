<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Map
 * @covers Image
 */
final class TestMap extends TestCase
{
    /**
     * @covers Map::__construct
     * @covers Map::getPath
     */
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
     * @covers Map::jsonSerialize
     */
    public function testJsonSerialize():void
    {
        $map = new Map("path.path");

        $json = $map->jsonSerialize();

        $this->assertCount(2, $json);

        $this->assertArrayHasKey("path", $json);
        $this->assertArrayHasKey("elements", $json);
    }
}