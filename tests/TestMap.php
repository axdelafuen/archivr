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
}