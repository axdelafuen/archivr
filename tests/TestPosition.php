<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

/**
 * @uses Position
 * @covers Position::__construct
 */
final class TestPosition extends TestCase
{
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

}