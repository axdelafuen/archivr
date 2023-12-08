<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Position
 * @covers Position::__construct
 */
final class TestPosition extends TestCase
{
    /**
     * @covers Position::getPosition
     */
    public function testCanBeCreatedPositionAndGet(): void
    {
        $positionString = "0 0 0";

        $position = new Position(0, 0, 0);

        $this->assertSame($positionString, $position->getPosition());
    }
    /**
     * @covers Position::setPosition
     */
    public function testCanSetPosition():void
    {
        $positionString = "0 0 0";

        $position = new Position(0, 0, 0);

        $this->assertSame($positionString, $position->getPosition());

        $x = 1;
        $y = 2;
        $z = 3;

        $position->setPosition($x,$y,$z);

        $this->assertSame(floatval($x), $position->getX());
        $this->assertSame(floatval($y), $position->getY());
        $this->assertSame(floatval($z), $position->getZ());
    }

    /**
     * @covers Position::setX
     * @covers Position::getX
     */
    public function testSetX():void
    {
        $x = 12;

        $position = new Position(0,0,0);

        $position->setX($x);

        $this->assertSame(floatval($x),$position->getX());
    }

    /**
     * @covers Position::setY
     * @covers Position::getY
     */
    public function testSetY():void
    {
        $y = 22;

        $position = new Position(0,0,0);

        $position->setY($y);

        $this->assertSame(floatval($y),$position->getY());
    }

    /**
     * @covers Position::setZ
     * @covers Position::getZ
     */
    public function testSetZ():void
    {
        $z = 18;

        $position = new Position(0,0,0);

        $position->setZ($z);

        $this->assertSame(floatval($z),$position->getZ());
    }

    /**
     * @covers Position::__toString
     */
    public function testToString():void
    {
        $position = new Position(1,2,3);
        $this->assertSame($position->__toString(), "1 2 3");
    }
}