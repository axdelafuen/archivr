<?php

class ImageModel
{
    private Image $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function addElement($element)
    {
        $array = $this->image->getElements();
        $array[] = $element;
        $this->image->setElements($array);
    }

    public function removeElement($element)
    {
        $array = $this->image->getElements();
        array_splice($array, array_search($element, $array), 1);
        $this->image->setElements($array);
    }

    public function getElementById($id):?Element
    {
        foreach ($this->image->getElements() as $element) {
            if ($element->getId() === $id) {
                return $element;
            }
        }
        return null;
    }
}
