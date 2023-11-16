<?php

abstract class Image
{
    protected string $id;

    protected string $path;

    protected array $elements = array(); // list of elements

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath(){
        return $this->path;
    }

    public function getName() : string
    {
        return substr($this->path, 0, strpos($this->path, "."));
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function addElement($element)
    {
        $this->elements[] = $element;
    }

}

?>