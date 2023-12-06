<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

/**
 * @uses Validation
 */
final class TestValidation extends TestCase
{
    /**
     * @covers Validation::val_action
     */
    public function testMissingAction(): void
    {
        $actions = array();

        $this->expectException(InvalidArgumentException::class);

        Validation::val_action($actions['action']);
    }

    /**
     * @covers Validation::val_texte
     */
    public function testValidText():void
    {
        $this->assertSame(Validation::val_texte('<span>filter</span>'), '&#60;span&#62;filter&#60;/span&#62;');
    }
}