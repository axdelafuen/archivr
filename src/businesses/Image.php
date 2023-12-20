<?php

abstract class Image implements JsonSerializable
{
    protected string $id;

    protected string $path;

    protected array $elements = array();

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getPath():string
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

    public function setElements(array $elements)
    {
        $this->elements = $elements;
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
