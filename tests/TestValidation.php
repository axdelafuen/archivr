<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Validation
 */
final class TestValidation extends TestCase
{
    /**
     * @covers Validation::valAction
     */
    public function testMissingAction(): void
    {
        $actions = array();

        $this->expectException(InvalidArgumentException::class);

        Validation::valAction($actions['action']);
    }

    /**
     * @covers Validation::valTexte
     */
    public function testValidText():void
    {
        $this->assertSame(Validation::valTexte('<span>filter</span>'), '&#60;span&#62;filter&#60;/span&#62;');
    }
}