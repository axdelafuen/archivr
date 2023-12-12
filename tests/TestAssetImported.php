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
     * @covers AssetImported::getModel
     * @covers AssetImported::setModel
     */
    public function testCanBeCreatedAssetImportedAndGetPath(): void
    {
        $nameZip = "&àcàç&cn&ciosc";

        $path = $nameZip.".gltf";

        $asset = new AssetImported($nameZip, $path);

        $this->assertSame($nameZip, $asset->getPath());

        $this->assertSame($path, $asset->getModel());
    }
    /**
     * @covers AssetImported::setScale
     * @covers AssetImported::getScale
     * @covers AssetImported::getScaleInt
     */
    public function testScaleAttributes():void
    {

        $name = "&àcàç&cn&ciosc";

        $path = $name.".gltf";

        $asset = new AssetImported($name, $path);

        $scale = 1.2;

        // test default value
        $this->assertSame($asset->getScale(), "1 1 1");

        $asset->setScale($scale);

        $this->assertSame($asset->getScaleInt(), $scale);

        $this->assertSame($asset->getScale(), (string)$scale." ".(string)$scale." ".(string)$scale);
    }

    /**
     * @covers AssetImported::jsonSerialize
     */
    public function testJsonSerialize():void
    {
        $name = "&àcàç&cn&ciosc";

        $path = $name.".gltf";

        $asset = new AssetImported($name, $path);

        $json = $asset->jsonSerialize();

        $this->assertCount(6, $json);

        $this->assertArrayHasKey("id", $json);
        $this->assertArrayHasKey("position", $json);
        $this->assertArrayHasKey("rotation", $json);
        $this->assertArrayHasKey("path", $json);
        $this->assertArrayHasKey("model", $json);
        $this->assertArrayHasKey("scale", $json);
    }
}