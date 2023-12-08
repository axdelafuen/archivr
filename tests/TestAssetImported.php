<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses AssetImported
 * @uses Position
 * @uses Rotation
 * @covers Element
 */
final class TestAssetImported extends TestCase
{
    /**
     * @covers AssetImported::__construct
     * @covers AssetImported::getPath
     * @covers AssetImported::getName
     */
    public function testCanBeCreatedAssetImportedAndGetPath(): void
    {
        $name = "&àcàç&cn&ciosc";

        $path = $name.".gltf";

        $asset = new AssetImported($path);

        $this->assertSame($path, $asset->getPath());

        $this->assertSame($name, $asset->getName());
    }
    /**
     * @covers AssetImported::setScale
     * @covers AssetImported::getScale
     * @covers AssetImported::getScaleInt
     */
    public function testScaleAttributes():void
    {

        $asset = new AssetImported("test.path");

        $scale = 1.2;

        // test default value
        $this->assertSame($asset->getScale(), "1 1 1");

        $asset->setScale($scale);

        $this->assertSame($asset->getScaleInt(), $scale);

        $this->assertSame($asset->getScale(), (string)$scale." ".(string)$scale." ".(string)$scale);
    }
}