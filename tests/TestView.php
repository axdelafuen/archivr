<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class TestView extends TestCase
{
    public function testCanBeCreatedViewAndGetPath(): void
    {
        $path = "&àcàç&cn&ciosc.jpg";

        $view = new View($path);

        $this->assertSame($path, $view->getPath());
    }

    public function testCanBeCreatedViewAndGetName(): void
    {
        $path = "&àcàç&cn&ciosc.jpg";

        $view = new View($path);

        $name = substr($path, 0, strpos($path, "."));

        $this->assertSame($name, $view->getName());
    }

}