<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @uses Image
 * @uses View
 * @uses Map
 */
final class TestImageModel extends TestCase
{
    /**
     * @covers ImageModel::__construct
     * @covers ImageModel::addElement
     * @covers ImageModel::getElementById
     * @covers ImageModel::removeElement
     */
    public function testElementsMethods(): void
    {
        $view = new View("test.path");

        $element = new Sign("test");

        $viewMdl = new ImageModel($view);

        $viewMdl->addElement($element);

        $this->assertSame($element->getContent(), $viewMdl->getElementById($element->getId())->getContent());

        $viewMdl->removeElement($element);

        $this->assertSame(0, count($view->getElements()));
    }
}
