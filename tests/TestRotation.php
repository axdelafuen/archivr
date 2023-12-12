<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Rotation
 * @covers Rotation::__construct
 */
final class TestRotation extends TestCase
{
    /**
     * @covers Rotation::getRotation
     */
    public function testCanBeCreatedRotationAndGet(): void
    {
        $rotationString = "0 0 0";

        $rotation = new Rotation(0, 0, 0);

        $this->assertSame($rotationString, $rotation->getRotation());
    }
    /**
     * @covers Rotation::setRotation
     */
    public function testCanSetRotation():void
    {
        $rotationString = "0 0 0";

        $rotation = new Rotation(0, 0, 0);

        $this->assertSame($rotationString, $rotation->getRotation());

        $x = 1;
        $y = 2;
        $z = 3;

        $rotation->setRotation($x,$y,$z);

        $this->assertSame(floatval($x), $rotation->getX());
        $this->assertSame(floatval($y), $rotation->getY());
        $this->assertSame(floatval($z), $rotation->getZ());
    }

    /**
     * @covers Rotation::setX
     * @covers Rotation::getX
     */
    public function testSetX():void
    {
        $x = 12;

        $rotation = new Rotation(0,0,0);

        $rotation->setX($x);

        $this->assertSame(floatval($x),$rotation->getX());
    }

    /**
     * @covers Rotation::setY
     * @covers Rotation::getY
     */
    public function testSetY():void
    {
        $y = 22;

        $rotation = new Rotation(0,0,0);

        $rotation->setY($y);

        $this->assertSame(floatval($y),$rotation->getY());
    }

    /**
     * @covers Rotation::setZ
     * @covers Rotation::getZ
     */
    public function testSetZ():void
    {
        $z = 18;

        $rotation = new Rotation(0,0,0);

        $rotation->setZ($z);

        $this->assertSame(floatval($z),$rotation->getZ());
    }

    /**
     * @covers Rotation::__toString
     */
    public function testToString():void
    {
        $rotation = new Rotation(1,2,3);
        $this->assertSame($rotation->__toString(), "1 2 3");
    }

    /**
     * @covers Rotation::jsonSerialize
     */
    public function testJsonSerialize():void
    {
        $rotation = new Rotation(1,2,3);

        $json = $rotation->jsonSerialize();

        $this->assertCount(3, $json);

        $this->assertArrayHasKey("x", $json);
        $this->assertArrayHasKey("y", $json);
        $this->assertArrayHasKey("z", $json);
    }
}