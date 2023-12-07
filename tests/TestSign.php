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

}