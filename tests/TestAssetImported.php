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
     */
    public function testCanBeCreatedAssetImportedAndGetPath(): void
    {
        $path = "&àcàç&cn&ciosc.gltf";

        $asset = new AssetImported($path);

        $this->assertSame($path, $asset->getPath());
    }

}