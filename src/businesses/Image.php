<?php

abstract class Image implements JsonSerializable
{
    protected string $id;

    protected string $path;

    protected array $elements = array(); // list of elements

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName() : string
    {
        return substr($this->path, 0, strpos($this->path, "."));
    }

    public function getElements():array
    {
        return $this->elements;
    }

    public function addElement($element)
    {
        $this->elements[] = $element;
    }

    public function removeElement($element)
    {
        array_splice($this->elements, array_search($element, $this->elements), 1);
    }

    public function getElementById($id)
    {
        foreach ($this->elements as $element) {
            if ($element->getId() === $id) {
                return $element;
            }
        }
        return null;
    }

    public function jsonSerialize():array
    {
        return get_object_vars($this);
    }

    public function set($data)
    {
        $this->elements = $data;
    }
}
