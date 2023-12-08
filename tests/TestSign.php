<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Sign
 * @uses Position
 * @uses Rotation
 * @covers Element
 */
final class TestSign extends TestCase
{
    /**
     * @covers Sign::__construct
     * @covers Sign::getContent
     */
    public function testCanBeCreatedSignAndGetContent(): void
    {
        $content = "test";

        $sign = new Sign($content);

        $this->assertSame($content, $sign->getContent());
    }

    /**
     * @covers Sign::setPosition
     * @covers Sign::setPositionX
     * @covers Sign::setPositionY
     * @covers Sign::setPositionZ
     * @covers Sign::setPositionXY
     * @covers Sign::setPositionXY
     * @covers Sign::getPosition
     */
    public function testPositionAttributes():void
    {
        $content = "test";

        $sign = new Sign($content);

        $position = new Position(0,0,0.1);

        $this->assertSame($sign->getPosition()->getPosition(), $position->getPosition());

        $position->setPosition(1,2,3);

        $sign->setPosition($position);

        $this->assertSame($sign->getPosition()->getPosition(), $position->getPosition());

        $x = 10;
        $y = 21;

        $sign->setPositionXY($x,$y);

        $this->assertSame($sign->getPosition()->getX(),floatval($x));
        $this->assertSame($sign->getPosition()->getY(),floatval($y));

        $x = 23;
        $y = 2;
        $z = 88;

        $sign->setPositionXYZ($x,$y,$z);

        $this->assertSame($sign->getPosition()->getX(),floatval($x));
        $this->assertSame($sign->getPosition()->getY(),floatval($y));
        $this->assertSame($sign->getPosition()->getZ(),floatval($z));

        $x = 3;
        $y = 98;
        $z = 29;

        $sign->setPositionX($x);
        $sign->setPositionY($y);
        $sign->setPositionZ($z);

        $this->assertSame($sign->getPosition()->getX(),floatval($x));
        $this->assertSame($sign->getPosition()->getY(),floatval($y));
        $this->assertSame($sign->getPosition()->getZ(),floatval($z));
    }

    /**
     * @covers Sign::setRotation
     * @covers Sign::setRotationX
     * @covers Sign::setRotationY
     * @covers Sign::setRotationZ
     * @covers Sign::setRotationXYZ
     * @covers Sign::getRotation
     */
    public function testRotationAttributes():void
    {
        $content = "test";

        $sign = new Sign($content);

        $rotation = new Rotation();

        $this->assertSame($sign->getRotation()->getRotation(), $rotation->getRotation());

        $rotation->setRotation(1,2,3);

        $sign->setRotation($rotation);

        $this->assertSame($sign->getRotation()->getRotation(), $rotation->getRotation());

        $x = 10;
        $y = 98;
        $z = 29;

        $sign->setRotationXYZ($x,$y,$z);

        $this->assertSame($sign->getRotation()->getX(),floatval($x));
        $this->assertSame($sign->getRotation()->getY(),floatval($y));
        $this->assertSame($sign->getRotation()->getZ(),floatval($z));

        $x = 76;
        $y = 18;
        $z = 67;

        $sign->setRotationX($x);
        $sign->setRotationY($y);
        $sign->setRotationZ($z);

        $this->assertSame($sign->getRotation()->getX(),floatval($x));
        $this->assertSame($sign->getRotation()->getY(),floatval($y));
        $this->assertSame($sign->getRotation()->getZ(),floatval($z));
    }

}